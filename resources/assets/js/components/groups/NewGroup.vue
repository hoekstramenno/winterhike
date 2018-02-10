<template>


        <form @submit.prevent="onSubmit()">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Group Number</label>
                    <input type="text" v-model="form.number" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Patrol name</label>
                    <input type="text" v-model="form.name" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Groupname</label>
                    <input type="text" v-model="form.groupname" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <button class="btn btn-success">Create</button>
                </div>
            </div>
        </form>

</template>

<script>
    export default {

        data() {
            return {
                form: new Form({name: '', number: '', groupname: '' })
            };
        },

        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id);
            }
        },

        methods: {
            onSubmit() {
                this.form
                    .post('/api/v1/groups')
                    .then(response => this.$emit('completed', response.data));
            }
        }
    }
</script>