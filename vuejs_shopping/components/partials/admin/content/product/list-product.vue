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
              <li class="breadcrumb-item active" aria-current="page">
                Product
              </li>
            </ol>
          </nav>
          <h1 class="mb-0 fw-bold">List Product</h1>
        </div>
        <div class="col-6">
          <div class="text-end upgrade-btn">
            <nuxt-link to="/admin/product/add">
              <a href="" class="btn btn-primary text-white" target="_blank"
                >Add</a
              >
            </nuxt-link>
          </div>
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
          <th scope="col">Name</th>
          <th scope="col">Code</th>
          <th scope="col">Description</th>
          <th scope="col">Image</th>
          <th scope="col">Price</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody v-for="product in products" :key="product.id">
        <tr>
          <th scope="row">{{ product.id }}</th>
          <td>{{ product.name }}</td>
          <td>{{ product.code }}</td>
          <td>{{ product.description }}</td>
          <td><img :src="`http://localhost:8000${product.image_url}`" /></td>
          <td>{{ product.price }}</td>
          <td>{{ product.category_id }}</td>
          <td>
            <nuxt-link :to="`/admin/product/${product.slug}`">
              <a href="" class="btn btn-default">Edit</a>
            </nuxt-link>
            <a
              href=""
              class="btn btn-danger"
              @click.prevent="deleteProduct(product.id)"
              >Delete</a
            >
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
      products: [],
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
    searchData() {
      let strSearchsearch = ''
      if (this.search !== '') {
        strSearchsearch = '?search=' + this.search
      }
      this.asyncData(strSearchsearch)
    },
    async asyncData(page = '1', strSearchsearch = '') {
      const res = await this.$axios.get(
        'admin/product?page=' + page + strSearchsearch
      )

      this.products = res.data.products
      this.pages = res.data.count
      this.previous = res.data.previous
      this.next = res.data.next
    },
    async deleteProduct(id) {
      await this.$axios.delete('admin/product/delete/' + id).then((res) => {
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
<style>
.mg10 {
  margin: 10px;
  width: 1000px;
}

img {
  width: 100px;
  height: 100px;
}
</style>
