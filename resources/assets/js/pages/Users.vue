<template>
    <div>
    <div class="panel panel-default">
        <div class="panel-heading">Group list</div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>roles</th>
                    <th width="140">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                    <template v-for="(item, index) in items">
                        <user :roles="roles" :data="item" @updated="update(index, item)" @deleted="remove(index)"></user>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</template>

<script>
    import Collection from '../core/Collection'
    import User from '../components/users/User'

    export default Collection.extend({
        components: {
            User
        },
        data: function () {
            return {
                roles: this.fetchRoles(),
                endpoint: '/api/v1/users'
            }
        },
        methods: {
            fetchRoles: function () {
                var app = this;
                axios.get('api/v1/roles')
                    .then(response => {
                        app.roles = response.data;
                    })
                    .catch(error => {
                        console.log(error)
                    });
            }
        }

    });
</script>