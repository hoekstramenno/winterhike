export default Vue.extend({
    data: function () {
        return {
           items: []
        }
    },
    created() {
        var app = this;
        axios.get(this.endpoint)
            .then(function (response) {
                app.items = response.data.data;
            });
    },
    methods: {
        add(item) {
            this.items.push(item);
            this.$emit('added');
        },
        update(index, item) {

        },
        remove(index) {
            this.items.splice(index, 1);
            this.$emit('removed');
        }
    }

});