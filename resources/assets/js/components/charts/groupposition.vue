<script>
    import Line from './BaseCharts/Line'

    export default {
        name: 'GroupPosition',
        extends: Line,
        data: function () {
            return {
                posts: [],
                groups: []
            }
        },
        created() {

        },
        mounted () {
            this.fetchPosts();
            this.fetchGroupsWithTimes();

            var app = this;
            this.renderChart({
                labels: app.posts,
                datasets: [
                    {
                        label: 'Ploeg 1',
                        borderColor: '#f87979',
                        fill: false,
                        data: ['1200', '1300', '1400']
                    },
                    {
                        label: 'Ploeg 2',
                        borderColor: 'green',
                        fill: false,
                        data: ['1230', '1320', '1410']
                    }
                ]
            }, {responsive: true, maintainAspectRatio: false})
        },
        methods: {
            fetchPosts() {
                var app = this;
                axios.get('/api/v1/posts')
                    .then(function (response) {
                        for (let post of response.data.data) {
                            app.posts.push(post.number);
                        }
                    });
            },
            fetchGroupsWithTimes() {
                var app = this;
                axios.get('/api/v1/groups')
                    .then(function (response) {
                        app.groups = response.data.data;
                    });
            }
        }

    }

</script>