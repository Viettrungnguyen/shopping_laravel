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
                Product/Edit
              </li>
            </ol>
          </nav>
          <h1 class="mb-0 fw-bold">Edit Product</h1>
        </div>
        <div class="col-6">
          <div class="text-end upgrade-btn">
            <nuxt-link to="/admin/product/">
              <a href="" class="btn btn-primary text-white" target="_blank"
                >List</a
              >
            </nuxt-link>
          </div>
        </div>
      </div>
    </div>

    <form action="" method="post" @submit.prevent="editProduct">
      <div class="row">
        <div class="col mb-3">
          <label>Name</label>
          <input
            v-model="product.name"
            type="text"
            class="form-control"
            name="name"
            placeholder="Name"
          />
          <span v-if="error['name']" class="text-danger">{{
            error['name'][0]
          }}</span>
        </div>

        <div class="col mb-3">
          <label>Code</label>
          <input
            v-model="product.code"
            type="text"
            class="form-control"
            name="code"
            placeholder="code"
          />
          <span v-if="error['code']" class="text-danger">{{
            error['code'][0]
          }}</span>
        </div>
      </div>

      <div class="row">
        <div class="col mb-3">
          <label>Description</label>

          <input
            v-model="product.description"
            type="text"
            class="form-control"
            name="description"
            placeholder="description"
          />
          <span v-if="error['description']" class="text-danger">{{
            error['description'][0]
          }}</span>
        </div>
      </div>

      <div class="row">
        <div class="col mb-3">
          <label for="tags-limit">Enter tags</label>
          <b-form-tags
            v-model="tags"
            input-id="tags-limit"
            remove-on-delete
          ></b-form-tags>
          <p class="mt-2">Value: {{ tags }}</p>
          <span v-if="error['tags']" class="text-danger">{{
            error['tags'][0]
          }}</span>
        </div>
      </div>

      <div class="row">
        <div class="col mb-3">
          <label>Image</label>
          <input
            class="form-control"
            type="file"
            name="image_url"
            @change="imageFile"
          />
          <input
            type="text"
            name="image_url"
            :value="`http://localhost:8000${product.image_url}`"
            hidden
          />
          <img :src="`http://localhost:8000${product.image_url}`" />

          <span v-if="error['image_url']" class="text-danger">{{
            error['image_url'][0]
          }}</span>
        </div>

        <div class="col mb-3">
          <label>Price</label>
          <input
            v-model="product.price"
            type="text"
            class="form-control"
            name="price"
            placeholder="price"
          />
          <span v-if="error['price']" class="text-danger">{{
            error['price'][0]
          }}</span>
        </div>

        <div class="col mb-3">
          <label>Category</label>
          <select
            v-model="product.category_id"
            class="form-control select2_init"
            name="category_id"
          >
            <option value="">Select Category</option>

            <option
              v-for="category in categories"
              :key="category.id"
              :value="`${category.id}`"
            >
              {{ category.name }}
            </option>
          </select>
          <span v-if="error['category_id']" class="text-danger">{{
            error['category_id'][0]
          }}</span>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</template>
<script>
import swal from 'sweetalert2'
export default {
  data() {
    return {
      tags: [],
      categories: '',
      product: {
        name: '',
        code: '',
        description: '',
        image_url: '',
        price: '',
        category_id: '',
      },
      selectFile: null,
      error: [],
    }
  },

  async mounted() {
    const res = await this.$axios.get(
      'admin/product/edit/' + this.$route.params.slug
    )
    // eslint-disable-next-line no-console
    console.log(res.data)
    this.product = res.data.product
    this.tags = res.data.tags
    this.categories = res.data.categories
  },

  methods: {
    imageFile(event) {
      this.selectFile = event.target.files[0]
      // eslint-disable-next-line no-console
      console.log(this.selectFile)
    },

    async editProduct() {
      const formData = new FormData()
      formData.append('image_url', this.selectFile)
      formData.append('name', this.product.name)
      formData.append('code', this.product.code)
      formData.append('description', this.product.description)
      formData.append('price', this.product.price)
      formData.append('category_id', this.product.category_id)

      for (let i = 0; i < this.tags.length; i++) {
        formData.append('tags[]', this.tags[i])
      }

      await this.$axios
        .post('admin/product/update/' + this.product.id, formData)
        .then((res) => {
          // eslint-disable-next-line no-console
          console.log(res)
          if (res.status === 200) {
            this.$router.push(
              { name: 'admin-product' },
              swal({
                title: `Cập nhật thành công`,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-success btn-fill',
              })
            )
          }
          // eslint-disable-next-line no-console
          console.log('result', res)
        })
        .catch((error) => {
          this.error = error.response.data.errors
          // eslint-disable-next-line no-console
          console.log(error.response.data.errors)
        })
    },
  },
}
</script>
