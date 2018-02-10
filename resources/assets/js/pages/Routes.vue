<template>
    <div>
    <div class="panel panel-default">
        <div class="panel-heading">Routes</div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Number</th>
                    <th>Start</th>
                    <th>Eind</th>
                    <th width="140">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                    <template v-for="(item, index) in items">
                        <hikeroute :data="item" @updated="update(index, item)" @deleted="remove(index)"></hikeroute>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Route
        </div>
        <div class="panel-body">
            <new-route @completed="add"></new-route>
        </div>
    </div>
    </div>
</template>

<script>
    import Collection from '../core/Collection'
    import Hikeroute from '../components/routes/Hikeroute'
    import NewRoute from '../components/routes/NewRoute'

    export default Collection.extend({
        components: {
            NewRoute, Hikeroute
        },
        data: function () {
            return {
                endpoint: '/api/v1/routes'
            }
        },
    });
</script>