<template>
  <div>
    <div class="maincontent-area">
      <div class="zigzag-bottom"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="latest-product">
              <h2 class="section-title">Latest Products</h2>
              <div class="product-carousel">
                <div
                  v-for="product in products"
                  :key="product.name"
                  class="single-product col-md-3"
                >
                  <div class="product-f-image">
                    <img
                      :src="`http://localhost:8000${product.image_url}`"
                      alt=""
                    />
                    <div class="product-hover">
                      <a @click="addToCart(product)" class="add-to-cart-link"
                        ><i class="fa fa-shopping-cart"></i> Add to cart</a
                      >
                      <nuxt-link
                        :to="`/web/${product.slug}`"
                        class="view-details-link"
                      >
                        <i class="fa fa-link"></i>
                        See details
                      </nuxt-link>
                    </div>
                  </div>

                  <h2>
                    <nuxt-link :to="`/web/${product.slug}`">{{
                      product.name
                    }}</nuxt-link>
                  </h2>

                  <div class="product-carousel-price">
                    <ins>$ {{ product.price }}</ins>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="brands-area">
      <div class="zigzag-bottom">
        <h2 class="section-title">All Category</h2>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="brand-wrapper">
              <div class="brand-list d-flex justify-content-between">
                <a
                  v-for="category in categories"
                  :key="category.name"
                  href=""
                  >{{ category.name }}</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End brands area -->
  </div>
</template>
<script>
// import swal from 'sweetalert2'

export default {
  data() {
    return {
      products: {
        name: '',
        image_url: '',
        price: '',
      },
      categories: '',
    }
  },
  mounted() {
    this.asyncData()
    
  },
  methods: {
    async asyncData() {
      const res = await this.$axios.get('/user/')
      this.products = res.data.products
      this.categories = res.data.categories
      // eslint-disable-next-line no-console
      console.log(res.data)
      console.log('cart do', this.$store.state.cart)
      console.log('count',this.$store.getters.cartItemCount)
    },

    addToCart(product) {
      this.$store.commit('ADD_TO_CART', {
        product: product,
        quantily: 1,
      })
    },
  },


}
</script>
<style>
.product-f-image img {
  width: 100% !important;
}

.zigzag-bottom h2 {
  color: black;
}
</style>
