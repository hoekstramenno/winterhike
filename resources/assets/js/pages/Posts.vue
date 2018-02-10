<template>
    <div>
    <div class="panel panel-default">
        <div class="panel-heading">Post list</div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Startpost</th>
                    <th>Eindpost</th>
                    <th width="140">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                    <template v-for="(item, index) in items">
                        <post :data="item" @updated="update(index, item)" @deleted="remove(index)"></post>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Post
        </div>
        <div class="panel-body">
            <new-post @completed="add"></new-post>
        </div>
    </div>
    </div>
</template>

<script>
    import Collection from '../core/Collection'
    import Post from '../components/posts/Post'
    import NewPost from '../components/posts/NewPost'

    export default Collection.extend({
        components: {
            NewPost, Post
        },
        data: function () {
            return {
                endpoint: '/api/v1/posts'
            }
        },
    });
</script>