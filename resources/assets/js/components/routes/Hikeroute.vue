<template>


    <tr v-if="editing">
        <td>
            <input class="form-control" v-model="form.number"/>
        </td>
        <td>
            <input class="form-control" v-model="form.post_start"/>
        </td>
        <td>
            <input class="form-control" v-model="form.post_end"/>
        </td>
        <td>
            <div v-if="canUpdate">
                <button class="btn btn-xs btn-primary" @click="update">Update</button>
                <button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>
            </div>
        </td>
    </tr>

    <tr v-else>
        <td>{{ form.number }}</td>
        <td>{{ form.post_start }}</td>
        <td>{{ form.post_end }}</td>
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
                    number: this.data.number,
                    post_start: this.data.post_start,
                    post_end: this.data.post_end
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
                console.log('gwar');
                this.form
                    .patch('/api/v1/routes/' + this.data.id)
                    .then(response => this.updateData(response));

                this.editing = false;
                flash('Updated the Route!');
            },
            updateData(response) {
                console.log(response);
                console.log('gwar');
                this.form.number = response.data.number;
                this.form.post_start = response.data.post_start;
                this.form.post_end = response.data.post_end;
            },
            destroy() {
                this.form
                    .delete('/api/v1/routes/' + this.data.id)
                    .then(response => this.$emit('deleted', this.data.id));
            }
        }
    }
</script>