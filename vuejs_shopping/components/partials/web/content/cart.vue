<template>
  <div>
    <div class="product-big-title-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="product-bit-title text-center">
              <h2>Shopping Cart</h2>
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
              <div class="woocommerce">
                <table cellspacing="0" class="shop_table cart">
                  <thead>
                    <tr>
                      <th class="product-remove">&nbsp;</th>
                      <th class="product-thumbnail">&nbsp;</th>
                      <th class="product-name">Product</th>
                      <th class="product-price">Price</th>
                      <th class="product-quantity">Quantity</th>
                      <th class="product-subtotal">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="item in cart"
                      :key="item.id"
                      class="cart_item"
                      data-id=""
                    >
                      <td class="product-remove">
                        <a
                          title="Remove this item"
                          class="remove"
                          href=""
                          @click="$store.commit('REMOVE_CART', item)"
                          ><i class="fa fa-trash-o data-id"></i
                        ></a>
                      </td>

                      <td class="product-thumbnail">
                        <a href=""
                          ><img
                            width="145"
                            height="145"
                            alt="poster_1_up"
                            class="shop_thumbnail"
                            :src="`http://localhost:8000${item.product.image_url}`"
                        /></a>
                      </td>

                      <td class="product-name">
                        <a href="single-product.html">{{
                          item.product.name
                        }}</a>
                      </td>

                      <td class="product-price">
                        <span class="amount">$ {{ item.product.price }}</span>
                      </td>

                      <td data-th="quantity">
                        <input
                          v-model="item.quantily"
                          type="number"
                          value=""
                          name="quantity"
                          class="form-control"
                        />
                        <button
                          @click="updateCart(item.product.id, item.quantily)"
                          type="button"
                          class="btn btn-success"
                        >
                          Update
                        </button>
                      </td>

                      <td class="product-subtotal">
                        <span class="amount"
                          >$ {{ item.product.price * item.quantily }}</span
                        >
                      </td>
                    </tr>

                    <tr>
                      <td class="actions" colspan="6">
                        <div class="coupon"></div>
                        <input
                          type="submit"
                          value="remove Cart"
                          name="update_cart"
                          class="button"
                          @click="removeCartItem"
                        />
                      
                          <input @click="checkout"
                            type="submit"
                            value="Checkout"
                            name="proceed"
                            class="checkout-button button alt wc-forward"
                          />
                    
                      </td>
                    </tr>
                  </tbody>
                </table>

                <div class="cart-collaterals">
                  <div class="cart_totals">
                    <h2>Cart Totals</h2>

                    <table cellspacing="0">
                      <tbody>
                        <tr class="cart-subtotal">
                          <th>Cart Subtotal</th>
                          <td>
                            <span class="amount">$ {{ cartTotalCart }}</span>
                          </td>
                        </tr>

                        <tr class="shipping">
                          <th>Quantity total</th>
                          <td>{{ cartItemCount }}</td>
                        </tr>

                        <tr class="order-total">
                          <th>Order Total</th>
                          <td>
                            <strong
                              ><span class="amount"
                                >$ {{ cartTotalCart }}</span
                              ></strong
                            >
                          </td>
                        </tr>
                      </tbody>
                      <form action="" method="get">
                        <input type="text" name="totalCart" value="" hidden />
                        <button
                          type="submit"
                          value="Checkout"
                          name="redirect"
                          class="checkout-button button alt wc-forward"
                        >
                          Checkout
                        </button>
                      </form>
                    </table>
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
import swal from 'sweetalert2'
import sidebarVue from '../../web/single-sidebar.vue'

export default {
  components: {
    sidebarVue,
  },
  data() {
    return {
      cart: [],
      vnp_Url:''
    }
  },

  mounted() {
    this.dataCart()
  },

  methods: {
    dataCart() {
      this.cart = this.$store.state.cart
      console.log('cart: ', this.cart)
      console.log('count', this.cartItemCount)
      console.log('total', this.$store.getters.cartTotalPrice)
    },

    removeCartItem() {
      this.$store.commit('REMOVE_CART_ITEM')
      this.dataCart()
    },

    updateCart(id, quantily) {
      this.$store.commit('UPDATE_CART', {
        id: id,
        quantily: quantily,
      })
    },

    async checkout() {
      const token = window.localStorage.getItem('token')

      await this.$axios
        .post('user/vnpay_payment', {
          cart: this.$store.state.cart,
          totalCart: this.$store.getters.cartTotalPrice,
        },{
           headers: { Authorization: token},
        })
        .then((res) => {
         console.log(res.data);
          if (res.status === 200) {
            this.$router.push(
              { path: '/web/login' },
              swal({
                title: `${res.data.message}`,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-success btn-fill',
              })
            )
          }

          if (res.status === 201) {
            this.dataCart()
            swal({
              title: `${res.data.message}`,
              buttonsStyling: false,
              confirmButtonClass: 'btn btn-success btn-fill',
            })
          }

           if (res.status === 202) {
            this.$router.push(
              { name: 'web-profile' },
              swal({
                title: `${res.data.message}`,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-success btn-fill',
              })
            )
          }

          if (res.status === 203) {
          window.open(res.data.url); 
          }
        })
    },
  },

  computed: {
    cartItemCount() {
      return this.$store.getters.cartItemCount
    },

    cartTotalCart() {
      return this.$store.getters.cartTotalPrice
    },
  },
}
</script>
<style>
td.product-thumbnail img {
  width: 70px !important;
  height: 100px !important;
}
</style>
