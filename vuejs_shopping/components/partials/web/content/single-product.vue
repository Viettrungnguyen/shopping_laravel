<template>
  <div>
    <div class="product-big-title-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="product-bit-title text-center">
              <h2>Shop</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="single-product-area">
      <div class="zigzag-bottom"></div>
      <div class="container">
        <div class="row">
          <sidebar-vue></sidebar-vue>

          <div class="col-md-8">
            <div class="product-content-right">
              <div class="product-breadcroumb">
                <a href="">Home</a>
                <a href="">Category Name</a>
                <a href="">{{ category.name }}</a>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="product-images">
                    <div class="product-main-img">
                      <img
                        :src="`http://localhost:8000${product.image_url}`"
                        alt=""
                      />
                    </div>

                    <div class="product-gallery">
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="product-inner">
                    <h2 class="product-name">{{ product.name }}</h2>
                    <div class="product-inner-price">
                      <ins>$ {{ product.price }}</ins> <del>$100.00</del>
                    </div>

                    <form action="" class="cart" @submit.prevent="addToCart">
                      <div class="quantity">
                        <input
                          v-model="quantily"
                          type="number"
                          size="4"
                          class="input-text qty text"
                          title="Qty"
                          value="1"
                          name="quantity"
                          min="1"
                          step="1"
                        />
                      </div>
                      <button class="add_to_cart_button" type="submit">
                        Add to cart
                      </button>
                    </form>

                    <div class="product-inner-category">
                      <p>
                        Category: <a href="">{{ category.name }}</a
                        >. Tags: <a href="">{{ tags[0] }}</a
                        >.
                      </p>
                    </div>

                    <div role="tabpanel">
                      <ul class="product-tab" role="tablist">
                        <li role="presentation" class="active">
                          <a
                            href="#home"
                            aria-controls="home"
                            role="tab"
                            data-toggle="tab"
                            >Description</a
                          >
                        </li>
                        <li role="presentation">
                          <a
                            href="#profile"
                            aria-controls="profile"
                            role="tab"
                            data-toggle="tab"
                            >Reviews</a
                          >
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div
                          role="tabpanel"
                          class="tab-pane fade in active"
                          id="home"
                        >
                          <h2>Product Description</h2>
                          <p>
                            {{ product.description }}
                          </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile">
                          <h2>Reviews</h2>
                          <div class="submit-review">
                            <p>
                              <label for="name">Name</label>
                              <input name="name" type="text" />
                            </p>
                            <p>
                              <label for="email">Email</label>
                              <input name="email" type="email" />
                            </p>
                            <div class="rating-chooser">
                              <p>Your rating</p>

                              <div class="rating-wrap-post">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                              </div>
                            </div>
                            <p>
                              <label for="review">Your review</label>
                              <textarea
                                name="review"
                                id=""
                                cols="30"
                                rows="10"
                              ></textarea>
                            </p>
                            <p><input type="submit" value="Submit" /></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="related-products-wrapper">
                <h2 class="related-products-title">Related Products</h2>
                <div class="row">
                  <div class="col-md-12">
                    <div class="related-products-carousel">
                      <div
                        v-for="relatedProduct in relatedProducts"
                        :key="relatedProduct.id"
                        class="single-product col-md-6"
                      >
                        <div class="product-f-image">
                          <img
                            :src="`http://localhost:8000${relatedProduct.image_url}`"
                            alt=""
                          />
                          <div class="product-hover">
                            <a href="" class="add-to-cart-link"
                              ><i class="fa fa-shopping-cart"></i> Add to
                              cart</a
                            >
                            <a href="" class="view-details-link"
                              ><i class="fa fa-link"></i> See details</a
                            >
                          </div>
                        </div>

                        <h2>
                          <a href="">{{ relatedProduct.name }}</a>
                        </h2>

                        <div class="product-carousel-price">
                          <ins>$ {{ relatedProduct.price }}</ins>
                          <del>$100.00</del>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import sidebarVue from '../../web/single-sidebar.vue'
export default {
  components: {
    sidebarVue,
  },
  data() {
    return {
      product: {
        name: '',
        price: '',
        description: '',
        image_url: '',
        tags: {
          name: '',
        },
      },
      category: {
        name: '',
      },
      relatedProducts: {
        name: '',
        price: '',
        description: '',
        image_url: '',
      },
      tags: [],
      quantily: 1,
    }
  },

  mounted() {
    this.asyncData()
  },

  methods: {
    async asyncData() {
      const res = await this.$axios.get(
        'user/single-product/' + this.$route.params.slug
      )
      console.log(res.data)
      this.product = res.data.singleProduct
      this.category = res.data.category
      this.relatedProducts = res.data.relatedProducts
      this.tags = res.data.tags
    },

    addToCart() {
      console.log('quantily: ', this.quantily)
      this.$store.commit('ADD_TO_CART', {
        product: this.product,
        quantily: this.quantily,
      })
    },
  },
}
</script>
<style>
.product-f-image {
  width: 100%;
}
</style>
