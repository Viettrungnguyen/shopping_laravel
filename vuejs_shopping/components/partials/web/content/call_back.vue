<template>
 <div>
    <div class="product-big-title-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="product-bit-title text-center">
              <h2>My Order</h2>
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
                      <th class="product-name">User order</th>
                      <th class="product-price">Code</th>
                      <th class="product-quantity">Create Time</th>
                       <th class="product-quantity">Status </th>
                      <th class="product-subtotal">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="order in myOder" :key="order.id"
                      class="cart_item"
                      data-id=""
                    >
                  
                      <td class="product-name">
                        <a href="single-product.html">{{order.customer_name}}</a>
                      </td>

                      <td class="product-price">
                        <span class="amount">{{order.order_number}}</span>
                      </td>

                      <td class="product-subtotal">
                        <span class="amount"
                          > {{order.created_at}}</span
                        >
                      </td>
                      <td >
                        <span class="badge badge-warning">{{order.status}}</span>
                      </td>
                      <td>
                       $ {{order.total}}
                      </td>
                    </tr>
  
                  </tbody>
                </table>
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
    myOder:''
  }
},

  mounted() {
    this.completeCart()
  },

  methods: {

    async completeCart() {
      await this.$axios
        .post('user/cart-complete/' + this.$route.query.vnp_TxnRef, {
          cart: this.$store.state.cart,
          totalCart: this.$store.getters.cartTotalPrice,
          vnp_TxnRef: this.$route.query.vnp_TxnRef,
          countCart: this.$store.getters.cartItemCount,
          idUser:this.$route.query.idUser,
        })
        .then((res) => {
          console.log('cart complete: ', res)
          if (res.status === 200) {
            console.log('123');
            swal({
              title: `Order thành công`,
              buttonsStyling: false,
              confirmButtonClass: 'btn btn-success btn-fill',
            })
            this.$store.commit('REMOVE_CART_ITEM')
          }

          if (res.status === 201) {
            console.log('das')
          }
        })
      const token = window.localStorage.getItem('token')

        const res =await this.$axios.get('user/my-order',{
           headers: { Authorization: token},
        })
        this.myOder=res.data
        console.log(res.data)
    },
  },
}
</script>
<style scoped>
.badge-warning{
  background-color: aqua;
}
</style>
