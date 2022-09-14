<template>
  <div>
    <!-- <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div> -->
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >
      <hearder-vue></hearder-vue>
      <sidebar-vue></sidebar-vue>
      <div class="page-wrapper">
        <nuxt></nuxt>
        <footer-vue></footer-vue>
      </div>
    </div>
  </div>
</template>
<script>
// import swal from 'sweetalert2'
import hearderVue from '~/components/partials/admin/hearder.vue'
import sidebarVue from '~/components/partials/admin/sidebar.vue'
import footerVue from '~/components/partials/admin/footer.vue'

export default {
  components: {
    hearderVue,
    sidebarVue,
    footerVue,
  },

  //   created() {
  //     this.checkLogin()
  //   },

  //   methods: {
  //      checkLogin() {
  //       const token = window.localStorage.getItem('token')
  //       if (token == null) {
  //         this.$router.push(
  //           { name: 'web' },
  //           swal({
  //             title: `Bạn không có quyền truy cập`,
  //             buttonsStyling: false,
  //             confirmButtonClass: 'btn btn-success btn-fill',
  //           })
  //         )
  //       }
  //     },
  //   },
}
</script>
