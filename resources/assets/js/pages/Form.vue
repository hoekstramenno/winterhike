<template>
    <div class="form-post">
        <div class="panel panel-default">
            <div class="panel-heading" >Post <span v-text="postid"></span>: <span v-text="postname"></span></div>
            <div class="panel-body">
                <ul>
                    <li class="row" v-for="(group, index) in groups">
                        <div class="col-xs-12">
                            <span v-text="group.number"></span>.
                            <span v-text="group.name"></span>
                        </div>
                        <score class="col-xs-12 col-sm-6 score" :group="group.id" :post="postid"></score>
                        <postTime class="col-xs-12 col-sm-6" :start="post.start" :end="post.end" :group="group.id" :post="postid"></postTime>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import Score from '../components/score/Score'
    import PostTime from '../components/time/Time'

    export default {
        components: {
            Score, PostTime
        },
        data: function () {
            return {
                groups: [],
                postid: 0,
                post: [],
                postname: ''
            }
        },
        watch: {
            '$route': 'fetchData'
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                var app = this;
                app.postid = this.$route.params.id;
                axios.get('/api/v1/groups')
                    .then(function (response) {
                        app.groups = response.data.data;
                    });
                axios.get('/api/v1/posts/' + app.postid)
                    .then(function (response) {
                        app.postname = response.data.name;
                        app.post = response.data;
                    });
            }
        }

    };
</script>