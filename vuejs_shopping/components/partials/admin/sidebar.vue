<template>
  <aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
        <ul id="sidebarnav">
          <li class="sidebar-item">
            <nuxt-link to="/admin">
              <a
                class="sidebar-link waves-effect waves-dark sidebar-link"
                href=""
                aria-expanded="false"
              >
                <i class="mdi mdi-view-dashboard"></i>
                <span class="hide-menu">Dashboard</span></a
              >
            </nuxt-link>
          </li>
          <li class="sidebar-item">
            <nuxt-link to="/admin/user">
              <a
                class="sidebar-link waves-effect waves-dark sidebar-link"
                href=""
                aria-expanded="false"
              >
                <i class="mdi mdi-account-network"></i>
                <span class="hide-menu">User</span></a
              >
            </nuxt-link>
          </li>
          <li class="sidebar-item">
            <nuxt-link
              to="/admin/category"
              class="sidebar-link waves-effect waves-dark sidebar-link"
            >
              <i class="mdi mdi-border-all"></i>
              <span class="hide-menu">Category</span>
            </nuxt-link>
          </li>

          <li class="sidebar-item">
            <nuxt-link
              to="/admin/product"
              class="sidebar-link waves-effect waves-dark sidebar-link"
            >
              <i class="mdi mdi-face"></i>
              <span class="hide-menu">Product</span>
            </nuxt-link>
          </li>

          <li class="sidebar-item">
            <nuxt-link
              to="/admin/order"
              class="sidebar-link waves-effect waves-dark sidebar-link"
            >
              <i class="mdi mdi-face"></i>
              <span class="hide-menu">Order</span>
            </nuxt-link>
          </li>

          <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href=""
                            aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Tags</span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href=""
                            aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Contact</span></a>
                    </li> -->
        </ul>
      </nav>
    </div>
  </aside>
</template>
<script>
export default {
  methods: {},
}
</script>
