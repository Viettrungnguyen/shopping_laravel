<template>
  <div class="bcblue">
    <div class="container">
      <div class="screen">
        <div class="screen__content">
          <form class="login" action="" method="post" @submit.prevent="login">
            <h1>LOGIN</h1>
            <div class="login__field">
              <i class="login__icon fas fa-envelope"></i>
                  <input
                    id="email"
                    v-model="user.email"
                    type="email"
                    class="login__input"
                    name="email"
                    placeholder="Email"
                  />
  <span v-if="error['email']" class="text-danger">{{error['email'][0]}}</span>
            </div>
            <div class="login__field">
              <i class="login__icon fas fa-lock"></i>

                  <input
                    id="password"
                    v-model="user.password"
                    type="password"
                    class="login__input"
                    name="password"
                    placeholder="Password"
                  />
  <span v-if="error['password']" class="text-danger">{{error['password'][0]}}</span>
            </div>
            <button type="submit" class="button login__submit">
              <span class="btn">Log In Now</span>
              <i class="button__icon fas fa-chevron-right"></i>
            </button>
          </form>

          <div class="social-login">
            <nuxt-link to="/register">
              <button class="button login__submit">
                <span class="button__text">register</span>
                <i class="button__icon fas fa-chevron-right"></i>
              </button>
            </nuxt-link>
          </div>
          <div class="social-icons">
            <a href="#" class="social-login__icon fab fa-google"></a>
            <a href="#" class="social-login__icon fab fa-instagram"></a>
            <a href="#" class="social-login__icon fab fa-facebook"></a>
            <a href="#" class="social-login__icon fab fa-twitter"></a>
          </div>
        </div>
        <div class="screen__background">
          <span
            class="screen__background__shape screen__background__shape4"
          ></span>
          <span
            class="screen__background__shape screen__background__shape3"
          ></span>
          <span
            class="screen__background__shape screen__background__shape2"
          ></span>
          <span
            class="screen__background__shape screen__background__shape1"
          ></span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import swal from 'sweetalert2'
import Vue from 'vue'

export default Vue.extend({
  data() {
    return {
      user: {
        email: '',
        password: '',
      },
      error: [],
    }
  },
  methods: {
    async login() {
      await this.$auth
        .login({
          data: this.user,
        })
        .then((res) => {
          // eslint-disable-next-line no-console
          console.log('dasd', res)
          if (res.status === 200) {
            this.$router.push(
              { name: 'admin' },
              swal({
                title: this.$auth.user.name`Login success`,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-success btn-fill',
              })
            )
          }
        })
        .catch((error) => {
          this.error = error.response.data.errors
          console.log(error)
        })
    },
  },
})
</script>
