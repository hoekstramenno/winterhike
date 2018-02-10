<template>
    <span>
        <button class="col-xs-5" :disabled="isStart" @click="updateArrival" v-model="form.arrival">{{ form.arrival }}</button>
        <div class="col-xs-2"></div>
        <button class="col-xs-5" :disabled="isEnd == 1" @click="updateDepartment" v-model="form.departure">{{ form.departure }}</button>
    </span>
</template>

<script>

    export default {
        props: ['group', 'post', 'end', 'start'],
        name: 'Time',

        data() {
            return {
                form: new Form({
                    arrival: 'Arrival',
                    departure: 'Departure'
                })
            };
        },

        created() {
            this.fetchData();
        },
        watch: {
            '$route': 'fetchData'
        },
        computed: {
            isEnd() {
                return this.end == 1;
            },
            isStart() {
                return this.start == 1;
            }
        },
        methods: {
            fetchData: function () {
                var app = this;
                axios.get('api/v1/posts/' + this.post + '/groups/' + this.group + '/time')
                    .then(response => {
                        console.log(response);
                        app.form.arrival = 'Arrival';
                        app.form.departure = 'Departure';

                        if (response.data.arrival) {
                            app.form.arrival = response.data.arrival;
                        }
                        if (response.data.departure) {
                            app.form.departure = response.data.departure;
                        }

                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            updateDepartment: function () {
                this.form
                    .patch('api/v1/posts/' + this.post + '/groups/' + this.group + '/departure')
                    .then(response => this.updateData(response));
            },
            updateArrival() {
                this.form
                    .patch('api/v1/posts/' + this.post + '/groups/' + this.group + '/arrival')
                    .then(response => this.updateData(response));
            },
            updateData(response) {
                this.form.arrival = response.data.arrival;
                this.form.departure = response.data.departure;

                if (typeof response.data.arrival == 'undefined') {
                    this.form.arrival = 'Arrival';
                }

                if (typeof response.data.departure == 'undefined') {
                    this.form.departure = 'Departure';
                }

                flash('Updated the Time!');
            }
        }


    }
</script>