<template>


        <tr v-if="editing">
            <td><input class="form-control" v-model="form.number"/></td>
            <td><input class="form-control" v-model="form.name"/></td>
            <td><input class="form-control" v-model="form.groupname"/></td>
            <td>
                <div v-if="canUpdate">
                    <button class="btn btn-xs btn-primary" @click="update">Update</button>
                    <button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>
                </div>
            </td>
        </tr>

        <tr v-else>
            <td>{{ form.number }}</td>
            <td>{{ form.name }}</td>
            <td>{{ form.groupname }}</td>
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
                    number: this.data.number,
                    groupname: this.data.groupname
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
                    .patch('/api/v1/groups/' + this.data.id)
                    .then(response => this.updateData(response));

                this.editing = false;
                flash('Updated!');
            },
            updateData(response) {
                this.form.name = response.data.name;
                this.form.groupname = response.data.groupname;
                this.form.number = response.data.number;
            },

            destroy() {
                this.form
                    .delete('/api/v1/groups/' + this.data.id)
                    .then(response => this.$emit('deleted', this.data.id));
            }
        }
    }
</script>