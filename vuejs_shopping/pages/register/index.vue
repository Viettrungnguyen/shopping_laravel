<template>
    <register></register>
</template>
<script>
import register from '~/components/common/register.vue';
export default {
    components: { register },
     auth: false,
}
</script>
<style scoped>
@import '~/assets/login/login.css';
</style>