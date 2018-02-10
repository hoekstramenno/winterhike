<template>


        <form @submit.prevent="onSubmit()">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Number</label>
                    <input type="text" v-model="form.number" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Postname</label>
                    <input type="text" v-model="form.name" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Address</label>
                    <input type="text" v-model="form.address" class="form-control">
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
                form: new Form({name: '', number: '', address: '' })
            };
        },

        methods: {
            onSubmit() {
                this.form
                    .post('/api/v1/posts')
                    .then(response => this.$emit('completed', response));
            }
        }
    }
</script>