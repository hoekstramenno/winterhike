<template>
        <tr v-if="editing">
            <td><input class="form-control" v-model="form.name"/></td>
            <td>
                <!--<div v-for="(item, index) in roles">-->
                    <!--<label>{{ ucfirst(item.name) }}</label>-->
                    <!--<input class="form-control" name="'roles[]" type="checkbox" v-model="item.id"/>-->
                <!--</div>-->
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
            <td>
                <!--<div v-for="(item, index) in roles">-->
                    <!--<label>{{ ucfirst(item.name) }}</label>-->
                    <!--<input class="form-control" name="'roles[]" type="checkbox" v-model="item.id"/>-->
                <!--</div>-->
            </td>
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
        props: ['data'],

        data() {
            return {
                editing: false,
                form: new Form({
                    name: this.data.name,
                    guard_name: this.data.guard_name,
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

        methods: {
            update() {
                this.form
                    .patch('/api/v1/permissions/' + this.data.id)
                    .then(response => this.updateData(response));

                this.editing = false;
                flash('Updated!');
            },

            updateData(response) {
                this.form.name = response.data.name;
                this.form.roles = response.data.roles;
            },

            destroy() {
                this.form
                    .delete('/api/v1/permissions/' + this.data.id)
                    .then(response => this.$emit('deleted', this.data.id));
            }
        }
    }
</script>