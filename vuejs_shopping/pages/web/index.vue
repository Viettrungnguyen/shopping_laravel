<template>
    <content-vue></content-vue>
</template>
<script>
import contentVue from '~/components/partials/web/content/home.vue'
export default {
    components: {
        contentVue
    },

    layout: 'web',
    auth: false,
}
</script>
<style>
@import  '~/assets/web/css/font-awesome.min.css';
@import  '~/assets/web/css/owl.carousel.css';
@import  '~/assets/web/css/responsive.css';
@import  '~/assets/web/css/style.css';
@import  '~/assets/web/css/bootstrap.min.css';
</style>

