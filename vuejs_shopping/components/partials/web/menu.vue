<template>
  <div class="row">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse fonz" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <nuxt-link class="nav-link px-5" to="/web/"
              ><span class="sr-only">(current)</span>Home</nuxt-link
            >
          </li>

          <li class="nav-item">
            <nuxt-link class="nav-link px-5" to="/web/cart">Cart</nuxt-link>
          </li>

          <li class="nav-item">
            <a class="nav-link px-5" href="#contact">Contact</a>
          </li>
          <li class="nav-item">
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
export default {}
</script>
<style scoped>
.fonz {
  font-size: 25px;
}
</style>
>
