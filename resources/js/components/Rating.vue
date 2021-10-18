<template>
    <div class="container">
        <star-rating
            :round-start-rating="false"
            @rating-selected="setRating"
            v-model:rating="data.rating"
            :read-only="readonly"
            :star-size="30">
        </star-rating>
    </div>
</template>

<script>
    import StarRating from 'vue-star-rating'
    export default {
        props: {
            id: Number,
            readonly: { type: Boolean, default: false }
        },
        components:{
            'star-rating': StarRating
        },
        data() {
            return {
                averageRating: null,
                data: {
                    rating: 0,
                    exercise_id: this.id,
                },
                resp: ''
            }
        },
        created() {
            this.getRating();
        },
        methods: {
            async getRating () {
                try {
                    await axios.get('http://formath.local/rating/' + this.id)
                        .then(response => (this.resp = response.data))
                    if(this.resp !== null){
                        this.data.rating = Number.parseFloat(this.resp)
                    }
                } catch (e) {
                    console.log(e)
                }
            },
            async setRating () {
                try {
                    await axios.post('http://formath.local/rating', this.data)
                        .then((response) => {
                            console.log(response.data);
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                    await this.getRating();
                } catch (err){
                    console.log(err)
                }
            }
        }
    }
</script>
