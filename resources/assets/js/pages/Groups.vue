<template>
    <div>
    <div class="panel panel-default">
        <div class="panel-heading">Group list</div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Groupname</th>
                    <th width="140">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                    <template v-for="(item, index) in items">
                        <group :data="item" @updated="update(index, item)" @deleted="remove(index)"></group>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Group
        </div>
        <div class="panel-body">
            <new-group @completed="add"></new-group>
        </div>
    </div>
    </div>
</template>

<script>
    import Collection from '../core/Collection'
    import Group from '../components/groups/Group'
    import NewGroup from '../components/groups/NewGroup'

    export default Collection.extend({
        components: {
            NewGroup, Group
        },
        data: function () {
            return {
                endpoint: '/api/v1/groups'
            }
        },
    });
</script>