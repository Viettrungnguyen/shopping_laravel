export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'shopping',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' },
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      {
        rel: 'icon',
        type: 'icon',
        href: 'https://fonts.googleapis.com/css?family=Raleway:400,700',
      },
      {
        rel: 'stylesheet',
        type: 'text/css',
        href: 'http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600',
      },
      {
        rel: 'stylesheet',
        type: 'text/css',
        href: 'http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300',
      },
      {
        rel: 'stylesheet',
        type: 'text/css',
        href: 'http://fonts.googleapis.com/css?family=Raleway:400,100',
      },
      {
        href: 'http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600',
        rel: 'stylesheet',
        type: 'text/css',
      },
      {
        href: 'http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300',
        rel: 'stylesheet',
        type: 'text/css',
      },
      {
        href: 'http://fonts.googleapis.com/css?family=Raleway:400,100',
        rel: 'stylesheet',
        type: 'text/css',
      },
    ],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [],
  script: [
    { src: '@/assets/admin/assets/libs/jquery/dist/jquery.min.js' },
    {
      src: '@/assets/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js',
    },
    { src: '@/assets/admin/dist/js/app-style-switcher.js' },
    { src: '@/assets/admin/dist/js/waves.js' },
    { src: '@/assets/admin/dist/js/sidebarmenu.js' },
    { src: '@/assets/admin/dist/js/custom.js' },
    { src: '@/assets/admin/assets/libs/chartist/dist/chartist.min.js' },
    {
      src: '@/assets/admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js',
    },
    { src: '@/assets/admin/dist/js/pages/dashboards/dashboard1.js' },

    { src: '@/assets/web/js/owl.carousel.min.js' },
    { src: '@/assets/web/js/jquery.sticky.js' },
    { src: '@/assets/web/js/jquery.easing.1.3.min.js' },
    { src: '@/assets/web/js/main.js' },
    { src: '@/assets/web/js/bxslider.min.js', type: 'text/javascript' },
    { src: '@/assets/web/js/script.slider.js', type: 'text/javascript' },
    {
      src: 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js',
    },
    { src: 'https://code.jquery.com/jquery.min.js' },
  ],
  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    { src: '~/plugins/vee-validate.js', ssr: true },
    { src: '~/plugins/persistedState.client.js',ssr: false },
    { src: '~/plugins/postcss.config.js' },
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/eslint
    '@nuxtjs/eslint-module',
    // https://go.nuxtjs.dev/stylelint
    '@nuxtjs/stylelint-module',
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/bootstrap
    'bootstrap-vue/nuxt',
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    // https://go.nuxtjs.dev/pwa
    '@nuxtjs/pwa',
    // https://go.nuxtjs.dev/content
    '@nuxt/content',
    '@nuxtjs/auth',
  ],

  module: {
    rules: [
      {
        test: /\.s[ac]css$/i,
        use: ['style-loader', 'css-loader', 'sass-loader'],
      },
    ],
  },

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    // Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
    baseURL: 'http://127.0.0.1:8000/api/',
  },
  auth: {
    redirect: {
      callback:'/admin',
      logout: '/login',
    },

    strategies: {
      local: {
        endpoints: {
          // các đường dẫn đến API
          // propertyName: kết quả từ API trả về, nhớ xem kết quả để đặt key cho đúng
          login: { url: '/login', method: 'post', propertyName: 'data.token' },
          // sau khi login, sẽ tự động chạy cái API này nữa để lấy dữ liệu user
          user: { url: 'api/auth/user', method: 'get' },
          logout: false,
        },
      },
    },
  },

  router: {
    middleware: ['auth'],
  },
  // PWA module configuration: https://go.nuxtjs.dev/pwa
  pwa: {
    manifest: {
      lang: 'en',
    },
  },

  // Content module configuration: https://go.nuxtjs.dev/config-content
  content: {},

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    transpile: ['vee-validate'],
  },
}
