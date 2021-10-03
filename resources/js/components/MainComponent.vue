<template>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8 my-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-style3 mg-b-0">
                                        <li class="breadcrumb-item" v-for="category in categorys" :key="category.id">
                                            <a style="cursor:pointer;" @click="getByCategory(category.id, category.name)">
                                                {{ category.name }}
                                            </a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="card">

                            <div class="card-header bg-light">{{ menuHeader }}</div>

                            <div class="card-body">

                                <div class="text-center" :class="menuLoader ? 'd-block' : 'd-none' ">
                                    <div class="spinner-border"></div>
                                </div>

                               <div class="row justify-content-center">
                                   <div class="col-5 mb-4" :class="menuLoader ? 'd-none' : 'd-block' " v-for="menu in viewMenu" :key="menu.id">
                                       <div class="card card-body bd-light p-0 py-3 animated fadeIn">
                                            <div class="marker marker-ribbon marker-dark pos-absolute t-10 l-0">Order Now!</div>
                                            <div class="border border-top-0 border-left-0 border-right-0">
                                                <img :src="getImage(menu.image_path)"
                                                alt="" class="img-fluid" width="300" height="200">
                                            </div>
                                            <div class="p-2">
                                                <h5 class="text-center">{{ menu.name }}</h5>
                                                <p class="mg-b-0">
                                                    <strong>Tax: </strong>
                                                    &#8369;{{ Number(menu.tax.toFixed(2)) }}
                                                </p>
                                                <p class="mg-b-0">
                                                    <strong>Price: </strong>
                                                    &#8369;{{ Number(menu.price.toFixed(2)) }}
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-sm btn-success mg-r-10 rounded-5"
                                                @click="order(menu.id, menu.price, menu.tax)"
                                                :disabled="carts.includes(menu.id)">
                                                    <span>{{ ordered.includes(menu.id) ? 'Ordered' : 'Order' }}</span>
                                                </button>
                                                <button @click="cancel(menu.id, menu.price, menu.tax)" type="button" class="btn btn-sm btn-light rounded-5"
                                                :disabled="!carts.includes(menu.id)">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                   </div>
                               </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-4">
                <div class="row">
                    <div class="col-12">

                <div class="card card-analytics-two">
                    <div class="card-header bg-light">
                        <h4 class="cart-title">
                            <i class="fas fa-shopping-cart"></i>
                            Cart Lists
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" v-if="carts.length == 0">
                                <div class="list-group-icon bg-danger tx-white"><i class="fas fa-times"></i></div>
                                <div class="list-body">
                                <h6>Empty Cart</h6>
                                <span>No orders available</span>
                                </div>
                            </li>
                            <li class="list-group-item" v-for="cart in carts" :key="cart">
                                <carts-component :menu="cart" />
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer bg-transparent" :class="carts.length == 0 ? 'd-none' : 'd-block' ">
                        <div class="d-flex justify-content-end">
                            <p class="text-success">
                                <strong>Total: </strong>
                                &#8369;{{ Number(total.toFixed(2)) }}
                            </p>
                        </div>
                        <form @submit.prevent="saveOrder">
                            <div class="form-group">
                                <input type="text" class="form-control rounded-5" v-model="post.coupons" placeholder="Coupons: 24Xs1">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control rounded-5" v-model="post.name" placeholder="Customers Name">
                            </div>
                            <button type="submit" class="btn btn-sm btn-info rounded-5" :disabled="post.name == '' || saveStatus == true">
                                <span>{{ saveStatus ? 'Saving...' : 'Save Order'}}</span>
                            </button>
                        </form>
                    </div>
                </div>

                    </div>
                    <div class="col-12 mt-3" v-if="localCarts.length > 0">
                        <div class="card card-analytics-two">
                            <div class="card-header bg-success-light">
                                <h4 class="cart-title text-dark">
                                    <i class="fas fa-luggage-cart"></i>
                                    Order Summary
                                </h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item" v-for="(lcart, index) in localCarts" :key="index">
                                        <carts-component :menu="lcart" />
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-end">
                                    <p>
                                        <strong>Total: </strong>
                                        <span class="text-danger" v-if="localCoupon == 0.1">
                                            <del>&#8369;{{ Number(localPartial).toFixed(2) }}</del>
                                        </span>
                                        <span class="text-warning font-weight-bold">
                                            &#8369;{{ Number(localTotal).toFixed(2) }}
                                        </span>
                                    </p>
                                </div>
                                <div class="alert text-center"
                                :class="localCoupon == 0.1 ? 'alert-success' : 'alert-danger'" role="alert">
                                    {{ localCoupon == 0.1 ? 'Discounted by &#8369;' + Number(localDiscount).toFixed(2) : localCoupon }}
                                </div>
                                <p class="mg-b-0">
                                    Customers Name: {{ localCustomer }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>

import CartsComponent from './CartsComponent.vue';

export default {

  components: { CartsComponent },

    data() {
        return {
            post: {
                coupons: '',
                name: '',
                carts: []
            },
            categorys: [],
            viewMenu: [],
            carts: [],
            ordered: [],
            localCarts: [],
            localCustomer: '',
            localTotal: 0,
            localDiscount: 0,
            localPartial: 0,
            localCoupon: '',
            menuHeader: '',
            menuLoader: true,
            total : 0,
            saveStatus: false,
        }
    },

    methods: {
        getCategory() {
            this.axios.get('/api/categorys')
            .then(res => {
                this.categorys = res.data;
            });
        },
        getMenu() {
            this.axios.get('/api/category/first')
            .then(res => {
                this.viewMenu = res.data;
                this.menuHeader = res.data[0].category.name
                this.menuLoader = false;
            })
        },
        getByCategory(id, name) {
            this.menuLoader = true;
            this.menuHeader = name;
            this.axios.get(`/api/category/${id}`)
            .then(res => {
                this.viewMenu = res.data;
                this.menuLoader = false;
            })
        },
        getImage(image) {
            return "/image/" + image;
        },
        order(id, price, tax) {
            let total = price + tax;
            this.total += total;
            this.post.carts.push({menu_id : id});
            this.carts.unshift(id);
            this.ordered.push(id);
        },
        cancel(id, price, tax) {
            let total = price + tax;
            this.total -= total;
            var index = this.carts.indexOf(id);
            var index1 = this.ordered.indexOf(id);
            var index2 = this.post.carts.indexOf(id);
            this.carts.splice(index, 1);
            this.ordered.splice(index1, 1);
            this.post.carts.splice(index2, 1);
        },
        saveOrder() {
            this.saveStatus = true;
            this.axios.post('/api/save/order', this.post)
            .then( res => {

                if(typeof res.data == "number") {
                    this.localDiscount = (this.total * res.data);
                }
                this.localPartial = this.total;
                this.localCoupon = res.data;
                this.localTotal = this.total - this.localDiscount;
                this.localCustomer = this.post.name;
                this.localCarts = this.carts;

                localStorage.setItem('cart', this.carts);
                localStorage.setItem('discount', this.localDiscount);
                localStorage.setItem('coupon', this.localCoupon);
                localStorage.setItem('customer', this.localCustomer);
                localStorage.setItem('total', this.localTotal);
                localStorage.setItem('partial', this.localPartial);

            })
            .catch(err => {
                console.log(err);
            })
            .finally(() => {
                this.saveStatus = false;
                this.post = {
                    coupons: '',
                    name: '',
                    carts: []
                };
                this.carts = [];
                this.ordered = [];
                this.total = 0;
            });
        }
    },

    created() {
        this.getCategory();
        this.getMenu();
        this.localCarts = localStorage.getItem('cart') ?? [];
        this.localDiscount = localStorage.getItem('discount') ?? 0;
        this.localCoupon = localStorage.getItem('coupon') ?? '';
        this.localCustomer = localStorage.getItem('customer') ?? '';
        this.localTotal = localStorage.getItem('total') ?? 0;
        this.localPartial = localStorage.getItem('partial') ?? 0;
    }

}
</script>


<style scoped>


</style>
