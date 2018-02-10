<template>
    <div>
        <label :for="'question-' + group.id">Right answers</label>
        <input v-cloak @change="update()" :name="'question-' + group.id" type="number" v-model="form.right_answers">
    </div>
</template>

<script>

    export default {
        props: ['group'],
        name: 'Question',

        data() {
            return {
                form: new Form({
                    right_answers: 0
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
                axios.get('api/v1/questions/' + this.group.id)
                    .then(response => {
                        app.updateData(response);
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            update() {
                this.form
                    .patch('api/v1/questions/' + this.group.id)
                    .then(response => this.updateData(response));
                flash('Updated the right anwers!');
            },
            updateData(response) {
                this.form.right_answers = response.data.right_answers;

                if (typeof response.data.right_answers == 'undefined') {
                    this.form.right_answers = 0;
                }

            }
        }


    }
</script>