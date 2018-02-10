<template>
    <span>
        <input class="col-xs-12" @change="update()" type="number" min="0" max="20" v-model="form.score">
    </span>
</template>

<script>

    export default {
        props: ['group', 'post'],

        data() {
            return {
                form: new Form({
                    score: 0
                })
            };
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
                axios.get('api/v1/posts/' + this.post + '/groups/' + this.group + '/score')
                    .then(response => {
                        if (response) {
                            app.form.score = response.data.score;
                        }
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            },
            update() {
                this.form
                    .patch('api/v1/posts/' + this.post + '/groups/' + this.group + '/score')
                    .then(response => this.updateData(response));
                flash('Updated the Score!');
            },
            updateData(response) {
                this.form.score = response.data.score;
            },
        }


    }
</script>