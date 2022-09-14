<template>
  <registerUser></registerUser>
</template>
<script>
import registerUser from '~/components/partials/web/auth/register.vue'
export default {
  components: {
    registerUser,
  },
  auth:false
}
</script>
<style scoped> 
@import '~/assets/login/login.css';
</style>