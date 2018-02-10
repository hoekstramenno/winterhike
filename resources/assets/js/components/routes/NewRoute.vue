<template>


        <form @submit.prevent="onSubmit()">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Number</label>
                    <input type="text" v-model="form.number" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Post start</label>
                    <select v-model="form.post_start">
                        <option disabled value="">Please select one</option>
                        <option v-for="post in posts" v-bind:value="post.id">
                            {{ post.number }}. {{ post.name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Post eind</label>
                    <select v-model="form.post_end">
                        <option disabled value="">Please select one</option>
                        <option v-for="post in posts" v-bind:value="post.id">
                            {{ post.number }}. {{ post.name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <button class="btn btn-success">Create</button>
                </div>
            </div>
        </form>

</template>

<script>
    export default {
        data() {
            return {
                posts: [],
                form: new Form({number: '', post_start: '', post_end: '' })
            };
        },
        created() {
            this.fetchData();
        },
        methods: {
            onSubmit() {
                this.form
                    .post('/api/v1/routes')
                    .then(response => this.$emit('completed', response));
            },
            fetchData: function () {
                var app = this;
                axios.get('api/v1/posts')
                    .then(response => {
                        console.log(response);
                        app.posts = response.data.data;
                    })
                    .catch(error => {
                        console.log(error)
                    });
            }
        }
    }
</script>