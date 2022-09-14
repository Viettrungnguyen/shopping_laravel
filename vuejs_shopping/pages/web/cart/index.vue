<template>
  <cart-vue></cart-vue>
</template>
<script>
import cartVue from '~/components/partials/web/content/cart.vue'
export default {
  components: {
    cartVue,
  },
  layout: 'web',
  auth: false,
}
</script>
