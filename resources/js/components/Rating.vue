<template>
    <div class="container">
        <star-rating :round-start-rating="false" v-model:rating="ratingLocal" :star-size="30"></star-rating>
        {{ ratingLocal }}
    </div>
</template>

<script>
    import StarRating from 'vue-star-rating'
    export default {
        props: {
            rating: Number,
            id: Number
        },
        components:{
            'star-rating': StarRating
        },
        data() {
            return {
                selectedRating: null,
                ratingLocal: this.rating
            }
        },
        mounted() {
            this.getRating();
        },
        methods: {
            async getRating () {
                this.isLoading = true
                try {
                    const { data } = await axios.get('http://formath.local/rating/' + this.id)
                    console.log(data)
                    this.selectedRating = data.data
                } catch (e) {

                }
            },
            async setRating () {

            }
        }
    }
</script>
