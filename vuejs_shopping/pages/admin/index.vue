<template>
  <div>
    <home-admin></home-admin>
  </div>
</template>
<script>
import homeAdmin from '~/components/partials/admin/content/home.vue'
export default {
  components: {
    homeAdmin,
  },
  layout: 'admin',
  auth: true,
}
</script>
<style>
@import '~/assets/admin/dist/css/style.min.css';
@import '~/assets/admin/assets/libs/chartist/dist/chartist.min.css';
@import '~/assets/admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css';
</style>
