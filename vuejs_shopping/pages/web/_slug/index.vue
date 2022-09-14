<template>
  <single-product-vue></single-product-vue>
</template>
<script>
import singleProductVue from '~/components/partials/web/content/single-product.vue'
export default {
  components: {
    singleProductVue,
  },
  layout: 'web',
  auth: false,
}
</script>
