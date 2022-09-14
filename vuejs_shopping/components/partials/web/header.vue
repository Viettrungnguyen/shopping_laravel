<template>
  <div class="row">
    <div class="col-md-8">
      <div class="user-menu">
        <ul>
          <li v-if="user !== null">
            <nuxt-link to="/web/profile"
              ><i class="fa fa-user"></i> My Account</nuxt-link
            >
          </li>
          <li>
            <a href="#"><i class="fa fa-heart"></i> Wishlist</a>
          </li>
          <li>
            <nuxt-link to="/web/cart"
              ><i class="fa fa-user"></i> My Cart</nuxt-link
            >
          </li>
          <li>
            <nuxt-link to="/web/call_back"
              ><i class="fa fa-user"></i> My Order</nuxt-link
            >
          </li>
          <li>
            <a v-if="user !== null" @click="logout" href=""><i class="fa fa-user"></i>Logout</a>
          </li>
          <li>
            <a v-if="user == null" @click="login"><i class="fa fa-user"></i>Login</a>
          </li>
        </ul>
      </div>
    </div>

    <div class="col-md-2 align-items-center d-flex">
      <div class="header-right" v-if="user !== null">
        <a
          >Hello <strong>{{ user.name }}</strong>
        </a>
      </div>
    </div>

    <div class="col-md-2 align-items-center d-flex">
      <div class="header-right">
        <button type="button" class="btn btn-primary">
          Notifications <span class="badge badge-light">4</span>
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import swal from 'sweetalert2'
export default {
  data() {
    return {
      user: [],
    }
  },

  mounted() {
    this.checkLogin()
  },

  methods: {
    login() {
      this.$router.push({ name: 'web-login' })
    },

    async logout() {
      const token = window.localStorage.getItem('token')
      await this.$axios
        .post('logout',{},{
          headers:
           {
            Authorization: token,
          },
        })
        .then((res) => {
          if (res.status === 200) {
            window.localStorage.removeItem('token')
            this.$router.push(
              { name: 'web' },
              swal({
                title: `Logout`,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-success btn-fill',
              })
            )
          }
        })
    },

    async checkLogin() {
      const token = window.localStorage.getItem('token')
      await this.$axios
        .get('auth-info', {
          headers: {
            Authorization: token,
          },
        })
        .then((res) => {
          console.log(res.data.user)
          this.user = res.data.user
        })
        .catch((error) => {
          this.$router.push({ name: 'web-login' })
          console.log(error.response)
        })
    },
  },
}
</script>
