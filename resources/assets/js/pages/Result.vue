<template>
    <div>
        <h1>Einduitslag Winterhike Haarlem 2018</h1>
        <table class="table is-bordered is-striped is-narrow">
            <thead>
            <tr>
                <th>#</th>
                <th>Groepsnaam</th>
                <th>Ploegnaam</th>
                <th>Vragen</th>
                <th>Posten</th>
                <th>Route 1</th>
                <th>Route 2</th>
                <th>Route 3</th>
                <th>Route 4</th>
                <th>Route 5</th>
                <th>Route 6</th>
                <th>Route 7</th>
                <th>Tijdscore</th>
                <th>Hints</th>
                <th>Nood</th>
                <th>Routescore</th>
                <th>Totaal score</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(result, index) in results">
                <td>{{ index + 1}}</td>
                <td>{{ result.group.name }}</td>
                <td>{{ result.group.groupname }}</td>
                <td><strong>{{ result.score.questions }}</strong></td>
                <td><strong>{{ result.score.posts }}</strong></td>
                <td v-bind:class="{'red': (route.time === '00:00:00'), 'alert': (route.seconds < 0)}" v-for="(route) in result.routes"><span>{{ route.time }} - {{ route.score }}</span></td>
                <td>{{ result.score.time }}</td>
                <td>{{ result.score.hints }}</td>
                <td>{{ result.score.emergency }}</td>
                <td><strong>{{ result.score.route }}</strong></td>
                <td><strong>{{ result.score.total }}</strong></td>
            </tr>
            </tbody>
        </table>
        <footer>
            <div class="container">
                <div class="has-text-centered">
                    <div class="copyright">Winterhike Haarlem 2018 &bull; Putten - *</div><br/>
                </div>
            </div>
        </footer>
    </div>
</template>


<script>
    import Collection from '../core/Collection'

    export default {
        data() {
            return {
                results: []
            };
        },
        watch: {
            '$route': 'fetchData'
        },
        created() {
            this.fetchData();
            console.log(this.results);
        },
        computed: {
            isTopTime: function () {
                return {
                    active: this.isActive && !this.error,
                    'text-danger': this.error && this.error.type === 'fatal'
                }
            }
        },
        methods: {
            fetchData() {
                var app = this;
                axios.get('/api/v1/results')
                    .then(response => {
                        console.log(response.data);
                        if (response) {
                            app.results = response.data;
                        }
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            }
        }
    };
</script>