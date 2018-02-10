<template>
    <div class="form-group">
        <label :for="form.path">{{ form.label }}</label>
        <input class="form-control" v-cloak @change="update()" :name="form.path" type="text" v-model="form.value">
    </div>
</template>

<script>

    export default {
        props: ['path'],

        data() {
            return {
                form: new Form({
                    type: 'text',
                    value: '',
                    label: ''
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
                axios.get('api/v1/settings/' + this.path)
                    .then(response => {
                        if (response) {
                            this.updateData(response);
                        }
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            },
            update() {
                this.form
                    .patch('api/v1/settings/value/' +  this.path)
                    .then(response => this.updateData(response));
                flash('Updated the setting!');
            },
            updateData(response) {
                if (typeof response.data !== 'undefined') {
                    response = response.data;
                }
                this.form.label = response.label;
                this.form.value = response.value;
            },
        }


    }
</script>