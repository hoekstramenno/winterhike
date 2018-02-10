<template>
    <div>
        <label :for="'emergency-' + group.id">Closed</label>
        <input v-cloak @change="update()" :name="'emergency-' + group.id" type="number" v-model="form.closed">
    </div>
</template>

<script>

    export default {
        props: ['group'],
        name: 'Emergency',

        data() {
            return {
                form: new Form({
                    closed: 0
                })
            };
        },

        created() {
            this.fetchData();
        },
        watch: {
            '$route': 'fetchData'
        },
        methods: {
            fetchData: function () {
                var app = this;
                axios.get('api/v1/emergencies/' + this.group.id)
                    .then(response => {
                        app.updateData(response);
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            update() {
                this.form
                    .patch('api/v1/emergencies/' + this.group.id)
                    .then(response => this.updateData(response));
                flash('Updated the emergency count!');
            },
            updateData(response) {
                this.form.closed = response.data.closed;

                if (typeof response.data.closed == 'undefined') {
                    this.form.closed = 0;
                }

            }
        }


    }
</script>