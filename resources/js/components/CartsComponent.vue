<template>

<div style="width: 100%">
    <div class="d-flex justify-content-center align-items-center" v-for="detail in details" :key="detail.id">
            <img :src="getImage(detail.image_path)" class="wd-30 rounded-circle mg-r-15" alt="">
            <div class="list-body">
                <h6>{{ detail.name }}</h6>
                <span>{{ detail.category.name }}</span>
            </div>
            <div class="list-visit">
                <span class="font-small-3">Tax: </span>
                &#8369;{{  Number(detail.tax.toFixed(2)) }}
            </div>
            <div class="list-rate tx-success">
                <span class="font-small-3">Price: </span>
                &#8369;{{ Number(detail.price.toFixed(2)) }}
            </div>
    </div>
</div>

</template>

<script>
export default {

    props: ['menu'],

    data () {
        return {
            details : [],
            total: 0
        }
    },

    methods: {

        getImage(image) {
            return "/image/" + image;
        },

    },

    created() {
        this.axios.get(`/api/menu/${this.menu}`)
        .then(res => {
            this.details = res.data;
        });

    }
}
</script>

