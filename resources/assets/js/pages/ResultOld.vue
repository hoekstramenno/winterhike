<template>
    <div>
        <h1>Einduitslag Winterhike Haarlem 2018 - Old Way</h1>
        <table class="table is-bordered is-striped is-narrow">
            <thead>
            <tr>
                <th>#</th>
                <th>Groepsnaam</th>
                <th>Ploegnaam</th>
                <th>Vragen</th>
                <th>Posten</th>
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
                <td>{{ result.number }}</td>
                <td>{{ result.name }}</td>
                <td><strong>{{ result.scores.questions }}</strong></td>
                <td><strong>{{ result.scores.posts }}</strong></td>
                <td>{{ result.scores.times }}</td>
                <td>{{ result.scores.hints }}</td>
                <td>{{ result.scores.emergency }}</td>
                <td><strong>{{ result.scores.total_route }}</strong></td>
                <td><strong>{{ result.total_score }}</strong></td>
            </tr>
            </tbody>
        </table>
        <footer>
            <div class="container">
                <div class="has-text-centered">
                    <div class="copyright">Winterhike Haarlem 2018 &bull; Putten - Zeewolde</div><br/>
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
                axios.get('/api/v1/old-results')
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