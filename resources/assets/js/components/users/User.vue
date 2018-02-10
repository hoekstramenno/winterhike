<template>
        <tr v-if="editing">
            <td><input class="form-control" v-model="form.name"/></td>
            <td><input class="form-control" v-model="form.email"/></td>
            <td>
                <ul class="roles-list">
                    <li v-for="(role, index) in roles.data">
                        <input v-model="form.roles" name="roles[]" type="checkbox" :value="role" />
                        <label for="roles">{{ role.name}}</label>
                    </li>
                </ul>
            </td>
            <td>
                <div v-if="canUpdate">
                    <button class="btn btn-xs btn-primary" @click="update">Update</button>
                    <button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>
                </div>
            </td>
        </tr>

        <tr v-else>
            <td>{{ form.name }}</td>
            <td>{{ form.email }}</td>
            <td>{{ form.roles | displayNames }}</td>
            <td>
                <div v-if="canUpdate">
                    <button class="btn btn-xs mr-1" @click="editing = true">Edit</button>
                    <button class="btn btn-xs btn-danger mr-1" @click="destroy">Delete</button>
                </div>
            </td>
        </tr>
</template>

<script>

    export default {
        props: ['data', 'roles'],

        data() {
            return {
                editing: false,
                form: new Form({
                    name: this.data.name,
                    email: this.data.email,
                    roles: this.data.roles
                })
            }
        },

        computed: {
            signedIn() {
                return true; //;window.App.signedIn;
            },

            canUpdate() {
                return true; //this.authorize(user => this.data.user_id == user.id);
            }
        },

        filters: {
            displayNames: function (array) {
                var names = [];
                for (var index = 0; index < array.length; index++) {
                    names.push(array[index].name)
                }
                return names.join(' ');
            }
        },

        methods: {
            update() {
                this.form
                    .patch('/api/v1/users/' + this.data.id)
                    .then(response => this.updateData(response));

                this.editing = false;
                flash('Updated!');
            },
            updateData(response) {
                this.form.name = response.data.name;
                this.form.email = response.data.email;
                this.form.roles = response.data.roles;
            },

            destroy() {
                this.form
                    .delete('/api/v1/users/' + this.data.id)
                    .then(response => this.$emit('deleted', this.data.id));
            }
        }
    }
</script>