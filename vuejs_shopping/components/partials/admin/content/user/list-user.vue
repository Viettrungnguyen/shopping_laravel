<template>
  <div>
    <!-- @include('partials.admin.content-header', ['name' => 'User', 'page' => 'List']) -->
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
              <li class="breadcrumb-item active" aria-current="page">User</li>
            </ol>
          </nav>
          <h1 class="mb-0 fw-bold">List User</h1>
        </div>
        <div class="col-6">
          <div class="text-end upgrade-btn">
            <nuxt-link to="/admin/user/add">
              <a href="" class="btn btn-primary text-white" target="_blank"
                >Add</a
              >
            </nuxt-link>
          </div>
        </div>
      </div>
    </div>

    <form action="" method="get" @submit.prevent="searchData()">
      <div class="input-group">
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
          <th scope="col">Email</th>
          <th scope="col">Gender</th>
          <th scope="col">Education</th>
          <th scope="col">Location</th>
          <th scope="col">Skills</th>
          <!-- <th scope="col">Note</th> -->
          <th scope="col">Birthday</th>
          <th scope="col">Status</th>
          <th scope="col">Avatar</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody v-for="user in users" :key="user.id">
        <tr>
          <th scope="row">{{ user.id }}</th>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.gender }}</td>
          <td>{{ user.education }}</td>
          <td>{{ user.location }}</td>
          <td>{{ user.skills }}</td>
          <!-- <td>{{ user.note }}</td> -->
          <td>{{ user.birthday }}</td>
          <td>{{ user.is_active }}</td>
          <td><img :src="`http://localhost:8000${user.avatar_url}`" /></td>

          <td>
            <div class="row">
              <div class="col-6">
                <nuxt-link :to="`/admin/user/${user.slug}`">
                  <a href="" class="btn btn-default">Edit</a>
                </nuxt-link>
              </div>
              <div class="col-6">
                <a
                  href=""
                  class="btn btn-danger"
                  @click.prevent="deleteUser(user.id)"
                  >Delete</a
                >
              </div>
            </div>
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
      users: [],
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
        'admin/user?page=' + page + strSearchsearch
      )

      this.users = res.data.users
      this.pages = res.data.count
      this.previous = res.data.previous
      this.next = res.data.next
    },

    async deleteUser(id) {
      await this.$axios.delete('admin/user/delete/' + id).then((res) => {
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
  width: 1200px;
}
</style>
