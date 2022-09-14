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
                Order/Edit
              </li>
            </ol>
          </nav>
          <h1 class="mb-0 fw-bold">Edit Order</h1>
        </div>
        <div class="col-6">
          <div class="text-end upgrade-btn">
            <nuxt-link to="/admin/order/">
              <a href="" class="btn btn-primary text-white" target="_blank"
                >List</a
              >
            </nuxt-link>
          </div>
        </div>
      </div>
    </div>

    <form action="" method="post" @submit.prevent="editOrder">
      <div class="row">
        <div class="col mb-3">
          <label>Status</label>
          <select
            v-model="order.status"
            class="form-control select2_init"
            name="status"
          >
            <option value="">Select Category</option>

            <option
              v-for="status in statusOrder"
              :key="status.id"
              :value="`${status}`"
            >
              {{ status }}
            </option>
          </select>
          <span v-if="error['status']" class="text-danger">{{
            error['status'][0]
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
      statusOrder: '',
      order: {
        status: '',
      },
      error: [],
    }
  },

  async mounted() {
    const res = await this.$axios.get(
      'admin/order/edit/' + this.$route.params.id
    )

    this.order = res.data.order
    this.statusOrder = res.data.status
  },

  methods: {
    async editOrder() {
      await this.$axios
        .patch('admin/order/update/' + this.order.id, {
          status: this.order.status,
        })
        .then((res) => {
          // eslint-disable-next-line no-console
          console.log(res)
          if (res.status === 200) {
            this.$router.push(
              { name: 'admin-order' },
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
          console.log(error.response.data.errors)
        })
    },
  },
}
</script>
