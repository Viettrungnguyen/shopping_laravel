<template>
  <loginUser></loginUser>
</template>
<script>
import loginUser from '~/components/partials/web/auth/login.vue'
export default {
  components: {
    loginUser,
  },
  auth: false,
}
</script>
<style scoped> 
@import '~/assets/login/login.css';
</style>
