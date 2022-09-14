<template>
  <div>
    <div class="page-breadcrumb">
      <div class="row align-items-center">
        <div class="col-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 d-flex align-items-center">
              <li class="breadcrumb-item">
                <nuxt-link to="/admin">
                  <a href="" class="link">
                    <i class="mdi mdi-home-outline fs-4"></i>
                  </a>
                </nuxt-link>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Order</li>
            </ol>
          </nav>
          <h1 class="mb-0 fw-bold">List Order</h1>
        </div>
        <div class="col-6">
          <div class="text-end upgrade-btn"></div>
        </div>
      </div>
    </div>

    <form action="" method="get" @submit.prevent="searchData()">
      <div class="input-group mg10">
        <input
          v-model="search"
          type="search"
          name="value"
          class="form-control rounded"
          placeholder="Search"
          aria-label="Search"
          aria-describedby="search-addon"
        />
        <button type="submit" class="btn btn-outline-primary">Search</button>
      </div>
    </form>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">User Order</th>
          <th scope="col">Code</th>
          <th scope="col">Phone</th>
          <th scope="col">Address</th>
          <th scope="col">Status</th>
          <th scope="col">Total</th>
          <th scope="col">Create Time</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody v-for="order in orders" :key="order.id">
        <tr>
          <th scope="row">{{ order.id }}</th>
          <td>{{ order.customer_name }}</td>
          <td>{{ order.order_number }}</td>

          <td>{{ order.customer_phone }}</td>
          <td>{{ order.customer_address }}</td>
          <td>
            <span v-if="order.status == 'complete'" class="badge badge-success">{{ order.status }}</span>
            <span v-if="order.status == 'waiting'" class="badge badge-warning">{{ order.status }}</span>
          </td>
          <td>{{ order.total }}</td>
          <td>{{ order.created_at }}</td>
          <td>
            <nuxt-link :to="`/admin/order/${order.id}`">
              <a href="" class="btn btn-default">Edit</a>
            </nuxt-link>
          </td>
        </tr>
      </tbody>
    </table>
    <nav aria-label="...">
      <ul class="pagination">
        <li class="page-item">
          <a @click="asyncData(previous)" class="page-link" href="#"
            >Previous</a
          >
        </li>
        <li v-for="page in pages" :key="page.id" class="page-item">
          <a @click="asyncData(page)" class="page-link" href="#">{{ page }}</a>
        </li>
        <li class="page-item">
          <a @click="asyncData(next)" class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav>
  </div>
</template>
<script>
import swal from 'sweetalert2'
export default {
  data() {
    return {
      orders: [],
      search: '',
      pages: '',
      previous: '',
      next: '',
    }
  },

  mounted() {
    this.asyncData()
  },

  methods: {
    async asyncData(page = '1', strSearchsearch = '') {
      const res = await this.$axios.get(
        'admin/order?page=' + page + strSearchsearch
      )
      // eslint-disable-next-line no-console
      console.warn('res:', res.data)
      this.orders = res.data.orders
      this.pages = res.data.count
      this.previous = res.data.previous
      this.next = res.data.next
    },

    searchData() {
      let strSearchsearch = ''
      if (this.search !== '') {
        strSearchsearch = '?search=' + this.search
      }
      this.asyncData(strSearchsearch)
    },

    async deleteCategory(id) {
      await this.$axios.get('admin/category/delete/' + id).then((res) => {
        // eslint-disable-next-line no-console
        console.warn(res)
        if (res.status === 200) {
          this.asyncData()
          swal({
            title: `Xóa thành công`,
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-success btn-fill',
          })
        }
      })
    },
  },
}
</script>
