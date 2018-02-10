<template>
    <div>
    <div class="panel panel-default">
        <div class="panel-heading">Permissions</div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Attached Role</th>
                    <th width="140">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                    <template v-for="(item, index) in items">
                        <permission :data="item" @updated="update(index, item)" @deleted="remove(index)"></permission>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Permission
        </div>
        <div class="panel-body">
            <new-permission @completed="add"></new-permission>
        </div>
    </div>
    </div>
</template>

<script>
    import Collection from '../core/Collection'
    import Permission from '../components/permissions/Permission'
    import NewPermission from '../components/permissions/NewPermission'

    export default Collection.extend({
        components: {
            NewPermission, Permission
        },
        data: function () {
            return {
                endpoint: '/api/v1/permissions'
            }
        },
    });
</script>