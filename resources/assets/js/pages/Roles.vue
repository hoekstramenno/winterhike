<template>
    <div>
    <div class="panel panel-default">
        <div class="panel-heading">Role</div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th width="140">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                    <template v-for="(item, index) in items">
                        <role :permissions="permissions" :data="item" @updated="update(index, item)" @deleted="remove(index)"></role>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Role
        </div>
        <div class="panel-body">
            <new-role :permissions="permissions" @completed="add"></new-role>
        </div>
    </div>
    </div>
</template>

<script>
    import Collection from '../core/Collection'
    import Role from '../components/roles/Role'
    import NewRole from '../components/roles/NewRole'

    export default Collection.extend({
        components: {
            NewRole, Role
        },
        data: function () {
            return {
                permissions: this.fetchPermissions,
                endpoint: '/api/v1/roles'
            }
        },
        created() {
            this.fetchPermissions();
        },
        methods: {
            fetchPermissions: function () {
                var app = this;
                axios.get('api/v1/permissions')
                    .then(response => {
                        app.updatePermissions(response);
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            updatePermissions(response) {
                this.permissions = response.data.data;
            }
        }
    });
</script>