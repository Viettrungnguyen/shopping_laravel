<template>
  <header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
      <div class="navbar-header" data-logobg="skin6">
        <a class="navbar-brand" href="index.html">
          <b class="logo-icon">
            <img
              src="~/assets/admin/assets/images/logo-icon.png"
              alt="homepage"
              class="dark-logo"
            />
            <img
              src="~/assets/admin/assets/images/logo-light-icon.png"
              alt="homepage"
              class="light-logo"
            />
          </b>
          <span class="logo-text">
            <img
              src="~/assets/admin/assets/images/logo-text.png"
              alt="homepage"
              class="dark-logo"
            />
            <img
              src="~/assets/admin/assets/images/logo-light-text.png"
              class="light-logo"
              alt="homepage"
            />
          </span>
        </a>
        <a
          class="nav-toggler waves-effect waves-light d-block d-md-none"
          href="javascript:void(0)"
          ><i class="mdi mdi-menu"></i
        ></a>
      </div>
      <div class="dropdown">
        <b-dropdown id="dropdown-1" class="m-md-2">
          <template #button-content>
            Hello <strong>{{ $auth.user.name }}</strong>
          </template>
          <b-dropdown-item>
            <a @click="profile">Profile</a>
          </b-dropdown-item>
          <b-dropdown-divider></b-dropdown-divider>
          <b-dropdown-item>
            <span class="font-normal text-sm mt-0/5" @click="logout"
              >Logout</span
            >
          </b-dropdown-item>
        </b-dropdown>
      </div>
    </nav>
  </header>
</template>
<script>
import swal from 'sweetalert2'
export default {
  methods: {
     logout() {
      this.$auth.logout()

      this.$router.push(
        { name: 'logout' },
        swal({
          title: `Logout`,
          buttonsStyling: false,
          confirmButtonClass: 'btn btn-success btn-fill',
        })
      )
    },

    profile(){
      this.$router.push({ name: 'admin-profile' })
    }
  },
}
</script>
<style scoped>
img {
  width: 60px;
  height: 30px;
}

.dropdown {
  margin-left: auto;
}
</style>
