<script>
    import Line from './BaseCharts/Line'

    export default {
        name: 'GroupPosition',
        extends: Line,
        data: function () {
            return {
                posts: [],
                groups: [],
                dataset: []
            }
        },
        created() {
        },
        mounted () {
            this.fetchPosts();
            this.fetchGroupsWithTimes();
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
                        app.createDataSet(response.data.data);

                        app.renderChart({
                            labels: app.posts,
                            datasets: app.dataset
                        }, {
                            responsive: true,
                            maintainAspectRatio: false,
                        });
                    });
            },
            createDataSet(groups) {
                let dataset = [], app = this;

                groups.forEach(function (group, key) {

                    let times = [];

                    group.relationships.times.forEach(function (time, key) {

                        if (time.post == 1) {
                            if (typeof time.departure !== 'undefined') {
                                times.push(time.departure.replace(/:/g,'').slice(0, -2));
                            }
                        }

                        if (typeof time.arrival !== 'undefined') {
                                times.push(time.arrival.replace(/:/g,'').slice(0, -2));
                        }
                    });

                    times.sort(app.sortNumber);

                    dataset.push({
                        label: group.groupname,
                        borderColor: app.getRandomColor(),
                        fill: false,
                        data: times
                    });
                });

                this.dataset = dataset;
            },
            sortNumber(a,b) {
                return a - b;
            },
            getRandomColor() {
                let letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
        }

    }

</script>