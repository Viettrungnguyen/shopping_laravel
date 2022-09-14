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
                            <li class="breadcrumb-item active" aria-current="page">Category/Edit</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Edit Category</h1>
                </div>
                <div class="col-6">
                    <div class="text-end upgrade-btn">
                        <nuxt-link to="/admin/category/">
                            <a href="" class="btn btn-primary text-white" target="_blank">List</a>
                        </nuxt-link>
                    </div>
                </div>
            </div>
        </div>

        <form action="" method="post" @submit.prevent="editCategory">
            <div class="row">
                <div class="col mb-3">
                    <label>Name</label>
                    <input v-model="category.name" type="text" class="form-control" name="name" placeholder="Name">
                      <span v-if="error['name']" class="text-danger">{{error['name'][0]}}</span>
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
            category: {
                name: '',
            },
            error:[]
        }
    },

    async mounted() {
        const res = await this.$axios.get('admin/category/edit/' + this.$route.params.slug)
        // eslint-disable-next-line no-console
        console.log(res.data)
        this.category = res.data
    },

    methods: {

        async editCategory() {
            await this.$axios.patch('admin/category/update/' + this.category.id, {
                name: this.category.name,
            }).then((res) => {
                // eslint-disable-next-line no-console
                console.log(res)
                if (res.status === 200) {
                    this.$router.push({ name: 'admin-category' },
                        swal({
                            title: `Cập nhật thành công`,
                            buttonsStyling: false,
                            confirmButtonClass: 'btn btn-success btn-fill'
                        })
                    )
                }
                // eslint-disable-next-line no-console
                console.log("result", res)
            }).catch(error => {
                    this.error = error.response.data.errors
                    console.log(error.response.data.errors)
                })
        }
    }
}
</script>
