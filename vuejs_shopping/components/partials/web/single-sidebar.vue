<template>
  <div class="col-md-4">
    <!-- <div class="single-sidebar">
            <h2 class="sidebar-title">Search Products</h2>
            <form action="">
                <input type="text" placeholder="Search products...">
                <input type="submit" value="Search">
            </form>
        </div> -->

    <div class="single-sidebar">
      <h2 class="sidebar-title">New Products</h2>
      <div
        v-for="newProduct in products"
        :key="newProduct.id"
        class="thubmnail-recent"
      >
        <img
          :src="`http://localhost:8000${newProduct.image_url}`"
          class="recent-thumb"
          alt=""
        />
        <h2>
          <nuxt-link :to="`/web/${newProduct.slug}`">{{
            newProduct.name
          }}</nuxt-link>
        </h2>
        <div class="product-sidebar-price">
          <ins>$ {{ newProduct.price }}</ins>
          <!-- <del>$100.00</del> -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  data() {
    return {
      products: {
        name: '',
        image_url: '',
        price: '',
      },
    }
  },

  async mounted() {
    const res = await this.$axios.get('user/new-product/')
    console.log(res.data)
    this.products = res.data
  },
}
</script>
