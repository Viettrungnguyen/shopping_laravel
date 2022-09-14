<template>
    <div>
        <div class="header-area">
        <div class="container">
         <header-vue></header-vue>
        </div>
    </div> <!-- End header area -->
    
    <div class="site-branding-area">
        <div class="container">
          <brand-vue></brand-vue>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area-web">
        <div class="container">
          <menu-vue></menu-vue>
        </div>
    </div> <!-- End mainmenu area -->
    
    <div class="slider-area">
        <!-- <slider-vue></slider-vue> -->
    </div> <!-- End slider area -->
         <nuxt></nuxt>   
    
          <footer-vue></footer-vue>
    </div>
</template>
<script>
import headerVue from "~/components/partials/web/header.vue";
import brandVue from "~/components/partials/web/brand.vue";
import menuVue from "~/components/partials/web/menu.vue";
// import sliderVue from "~/components/partials/web/slider.vue";
import footerVue from "~/components/partials/web/footer.vue";
export default {
  components : {
      headerVue,
    brandVue,
    // sliderVue,
    menuVue,
    footerVue,
  },
 auth:false,
  
}
</script>
