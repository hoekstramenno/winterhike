<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">Rest of the scores</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Questions</th>
                        <th>Emergencies</th>
                        <th>Hints</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item, index) in items">
                        <td>{{item.number}}</td>
                        <td>{{item.name}}</td>
                        <td><question :group="item"></question></td>
                        <td><emergency :group="item"></emergency></td>
                        <td><hint :group="item"></hint></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>


<script>
    import Collection from '../core/Collection'
    import Question from '../components/question/Question'
    import Emergency from '../components/emergency/Emergency'
    import Hint from '../components/hint/Hint'

    export default Collection.extend({
        components: {
            Question,
            Emergency,
            Hint
        },
        data: function () {
            return {
                endpoint: '/api/v1/groups'
            }
        },
    });
</script>