<template>


        <tr v-if="editing">
            <td><input class="form-control" v-model="form.name"/></td>
            <td>
                <ul class="roles-list">
                    <li v-for="(permission, index) in permissions">
                        <input v-model="form.permissions" name="permissions[]" type="checkbox" :value="permission" />
                        <label for="permissions">{{ permission.name}}</label>
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
            <td>{{ form.permissions | displayNames }}</td>
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
        props: ['data', 'permissions'],

        data() {
            return {
                editing: false,
                form: new Form({
                    name: this.data.name,
                    guard_name: this.data.guard_name,
                    permissions: this.data.permissions
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
                console.log(array);
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
                    .patch('/api/v1/roles/' + this.data.id)
                    .then(response => this.updateData(response));

                this.editing = false;
                flash('Updated!');
            },
            updateData(response) {
                console.log(response.data);
                this.form.name = response.data.name;
                this.form.guard_name = response.data.guard_name;
                this.form.permissions = response.data.permissions;
            },

            destroy() {
                this.form
                    .delete('/api/v1/roles/' + this.data.id)
                    .then(response => this.$emit('deleted', this.data.id));
            }
        }
    }
</script>