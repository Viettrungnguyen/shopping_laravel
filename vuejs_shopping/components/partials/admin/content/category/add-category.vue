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
                            <li class="breadcrumb-item active" aria-current="page">Category/Add</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Add Category</h1>
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
        <form action="" method="post" @submit.prevent="addCategory">
            <div class="row">
                <div class="col mb-3">
                    <label>Name</label>
                    <input v-model="category.name" type="text" class="form-control" name="name" placeholder="Name">
                    <span v-if="error['name']" class="text-danger">{{error['name'][0]}}</span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
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
            error: []
        }
    },
    methods: {
        async addCategory() {
            await this.$axios.post('admin/category/store',
                {
                    name: this.category.name,
                }).then((res) => {
                    // eslint-disable-next-line no-console
                    console.log(res)

                    if (res.status === 200) {
                        this.$router.push({ name: 'admin-category' },
                            swal({
                                title: `Thêm bài viết thành công`,
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

            // }
        }
    }
}
</script>
