<template>
    <div class="bcblue">
        <div class="container">
            <div class="screen">
                <div class="screen__content">
                    <form class="login" action="" method="POST" @submit.prevent="register">
                        <h1>REGISTER</h1>
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <input v-model="user.name" type="text" class="login__input" placeholder="Name">

                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-envelope"></i>
                            <input v-model="user.email" type="text" class="login__input" placeholder="Email">

                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input v-model="user.password" type="password" class="login__input" placeholder="Password">

                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input v-model="user.password_confirmation" type="password" class="login__input"
                                placeholder="Password Confirmation">

                        </div>
                        <button type="submit" class="button login__submit">
                            <span class="button__text">register</span>
                            <i class="button__icon fas fa-chevron-right"></i>
                        </button>
                    </form>
                    <div class="social-login">
                        <nuxt-link to="/web/login">
                            <button class="button login__submit">
                                <span class="button__text">Login</span>
                                <i class="button__icon fas fa-chevron-right"></i>
                            </button>
                        </nuxt-link>
                    </div>
                </div>

                <div class="screen__background">
                    <span class="screen__background__shape screen__background__shape4"></span>
                    <span class="screen__background__shape screen__background__shape3"></span>
                    <span class="screen__background__shape screen__background__shape2"></span>
                    <span class="screen__background__shape screen__background__shape1"></span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import swal from 'sweetalert2';
export default {
    data() {
        return {
            user:
            {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },

    methods: {
        async register() {
            await this.$axios.post('register', {
                name:this.user.name,
                email:this.user.email,
                password:this.user.password,
                password_confirmation:this.user.password_confirmation
            }).then((res) => {
                // eslint-disable-next-line no-console
                console.log(res);
                if (res.status === 401) {
                    this.$router.push({ name: 'web-register' },
                        swal({
                            title: `register fail`,
                            buttonsStyling: false,
                            confirmButtonClass: 'btn btn-danger btn-fill'
                        })
                    )
                }
                if (res.status === 200) {
                    this.$router.push({ name: 'web-login' },
                        swal({
                            title: `login now`,
                            buttonsStyling: false,
                            confirmButtonClass: 'btn btn-success btn-fill'
                        })
                    )
                }
            })
        }
    }
}
</script>
