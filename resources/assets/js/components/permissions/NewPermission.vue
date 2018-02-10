<template>

        <form @submit.prevent="onSubmit()">

            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Name</label>
                    <input type="text" v-model="form.name" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Guard name</label>
                    <input type="text" v-model="form.guard_name" class="form-control">
                </div>
            </div>
            <!--<div class="row">-->
                <!--<div v-if="form.roles.length > 0" class="col-xs-12 form-group">-->
                    <!--<h4>Assign Permission to Roles</h4>-->
                    <!--<div v-for="(item, index) in form.roles">-->
                        <!--<label>{{ ucfirst(item.name) }}</label>-->
                        <!--<input class="form-control" name="'roles[]" type="checkbox" v-model="item.id"/>-->
                    <!--</div>-->

                <!--</div>-->
            <!--</div>-->
            <div class="row">
                <div class="col-xs-12 form-group">
                    <button class="btn btn-success">Create</button>
                </div>
            </div>
        </form>

</template>

<script>
    export default {
        props: ['permissions'],
        data() {
            return {
                form: new Form({name: '', guard_name: '' })
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
                    .post('/api/v1/permissions')
                    .then(response => this.$emit('completed', response.data));
            }
        }
    }
</script>