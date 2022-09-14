<template>
  <div class="row">
    <div class="col-sm-6">
      <div class="logo">
        <h1>
          <a href="./"><img src="~assets/web/img/logo.png" /></a>
        </h1>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="shopping-item">
        <nuxt-link to="/web/cart">
          Cart - <span class="cart-amunt">$ {{ cartTotalCart }}</span>
          <i class="fa fa-shopping-cart"></i>
          <span class="product-count">{{ cartItemCount }}</span></nuxt-link
        >
      </div>
    </div>
  </div>
</template>
<script>
export default {
  computed: {
    cartTotalCart() {
      return this.$store.getters.cartTotalPrice
    },
    cartItemCount() {
      return this.$store.getters.cartItemCount
    },
  },
}
</script>
