<template>
  <div class="bcblue">
    <div class="container">
      <div class="screen">
        <div class="screen__content">
          <form class="login" action="" method="post" @submit.prevent="login">
            <h1>LOGIN</h1>
            <div class="login__field">
              <i class="login__icon fas fa-envelope"></i>
              <ValidationObserver ref="registrationForm">
                <ValidationProvider
                  v-slot="{ errors }"
                  immediate
                  name="email"
                  rules="required|email"
                >
                  <input
                    id="email"
                    v-model="user.email"
                    type="email"
                    class="login__input"
                    name="email"
                    placeholder="Email"
                  />
                  <span class="text-danger">{{ errors[0] }}</span>
                </ValidationProvider>
              </ValidationObserver>
            </div>
            <div class="login__field">
              <i class="login__icon fas fa-lock"></i>
              <ValidationObserver ref="registrationForm">
                <ValidationProvider
                  v-slot="{ errors }"
                  immediate
                  name="password"
                  rules="required"
                >
                  <input
                    id="password"
                    v-model="user.password"
                    type="password"
                    class="login__input"
                    name="password"
                    placeholder="Password"
                  />
                  <span class="text-danger">{{ errors[0] }}</span>
                </ValidationProvider>
              </ValidationObserver>
            </div>
            <button type="submit" class="button login__submit">
              <span class="btn">Log In Now</span>
              <i class="button__icon fas fa-chevron-right"></i>
            </button>
          </form>

          <div class="social-login">
            <nuxt-link to="/web/register">
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
    }
  },

  methods: {
   async login() {

   await this.$axios.post('http://127.0.0.1:8000/api/login', {
      email: this.user.email,
      password: this.user.password,
    })
    .then((res) => {
          if (res.status === 200) {
            window.localStorage.setItem('token','Bearer '+ res.data.data.token)
             this.$router.push(
                { name: 'web' },
                swal({
                  title: `Login success`,
                  buttonsStyling: false,
                  confirmButtonClass: 'btn btn-success btn-fill',
                })
              )
          } else {
            console.log('oki23')
          }
        })
        .catch((error) => {
          this.errors = error.res.data
          console.log(this.errors)
        })
    },
  },
})
</script>
