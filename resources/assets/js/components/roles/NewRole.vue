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
                <!--<div class="col-xs-12 form-group">-->
                    <!--<h5><b>Assign Permissions</b></h5>-->
                    <!--<div class='form-group'>-->
                        <!--<div class="form-control" v-for="(item, index) in permissions">-->
                            <!--<label>{{ item.name }}</label>-->
                            <!--<input  name="'permissions[]" type="checkbox" v-model="item.id"/>-->
                        <!--</div>-->
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
                form: new Form({
                    name: '',
                    guard_name: ''
                })
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
                    .post('/api/v1/roles')
                    .then(response => this.$emit('completed', response.data));
            }
        }
    }
</script>