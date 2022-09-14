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
                User/Edit
              </li>
            </ol>
          </nav>
          <h1 class="mb-0 fw-bold">Edit User</h1>
        </div>
        <div class="col-6">
          <div class="text-end upgrade-btn">
            <nuxt-link to="/admin/user/">
              <a href="" class="btn btn-primary text-white" target="_blank"
                >List</a
              >
            </nuxt-link>
          </div>
        </div>
      </div>
    </div>

    <form action="" method="post" @submit.prevent="editUser">
      <div class="row">
        <div class="col mb-3">
          <label>Name</label>
          <input
            v-model="user.name"
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
          <label>Email</label>
          <input
            v-model="user.email"
            type="email"
            class="form-control"
            name="email"
            placeholder="email"
          />
          <span v-if="error['email']" class="text-danger">{{
            error['email'][0]
          }}</span>
        </div>
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input
          v-model="user.password"
          type="text"
          class="form-control"
          name="password"
          placeholder="Password"
        />
        <span v-if="error['password']" class="text-danger">{{
          error['password'][0]
        }}</span>
      </div>

      <div class="mb-3">
        <label>Title</label>
        <textarea
          id="mytextarea"
          v-model="user.title"
          class="form-control"
          rows="3"
          name="title"
        ></textarea>
        <span v-if="error['title']" class="text-danger">{{
          error['title'][0]
        }}</span>
      </div>

      <div class="row">
        <div class="col mb-3">
          <label>Gender</label>
          <select
            v-model="user.gender"
            class="form-control select2_init"
            name="gender"
          >
            <option value="">Select Gender</option>

            <option value="nam">nam</option>
            <option value="nữ">nữ</option>
          </select>
          <span v-if="error['gender']" class="text-danger">{{
            error['gender'][0]
          }}</span>
        </div>

        <div class="col mb-3">
          <label>Avatar</label>
          <input class="form-control" type="file" @change="imageFile" />
          <img :src="`http://localhost:8000${user.avatar_url}`" />
        </div>
      </div>

      <div class="row">
        <div class="col mb-3">
          <label>Education</label>
          <input
            v-model="user.education"
            type="text"
            class="form-control"
            name="education"
            placeholder="Education"
          />
          <span v-if="error['education']" class="text-danger">{{
            error['education'][0]
          }}</span>
        </div>

        <div class="col mb-3">
          <label>Location</label>
          <input
            v-model="user.location"
            type="text"
            class="form-control"
            name="location"
            placeholder="Location"
          />
          <span v-if="error['location']" class="text-danger">{{
            error['location'][0]
          }}</span>
        </div>
        <div class="col mb-3">
          <label>Phone</label>
          <input
            v-model="user.phone"
            type="text"
            class="form-control"
            name="phone"
            placeholder="Phone"
          />
        </div>
      </div>

      <div class="mb-3">
        <label>Note</label>
        <textarea
          id="mytextarea"
          v-model="user.note"
          class="form-control"
          rows="3"
          name="note"
        ></textarea>
        <span v-if="error['note']" class="text-danger">{{
          error['note'][0]
        }}</span>
      </div>

      <div class="mb-3">
        <label>Skills</label>
        <textarea
          id="mytextarea"
          v-model="user.skills"
          class="form-control"
          rows="3"
          name="skills"
        ></textarea>
        <span v-if="error['skills']" class="text-danger">{{
          error['skills'][0]
        }}</span>
      </div>

      <div class="row">
        <div class="col mb-3">
          <label>Birthday</label>
          <input
            v-model="user.birthday"
            type="date"
            class="form-control"
            name="birthday"
            placeholder="Birthday"
          />
          <span v-if="error['birthday']" class="text-danger">{{
            error['birthday'][0]
          }}</span>
        </div>

        <div class="col mb-3">
          <label>Status</label>
          <select
            v-model="user.is_active"
            class="form-control select2_init"
            name="is_active"
          >
            <option value="">Select Status</option>

            <option value="active">active</option>
            <option value="deactive">deactive</option>
          </select>
          <span v-if="error['is_active']" class="text-danger">{{
            error['is_active'][0]
          }}</span>
        </div>

        <div class="col mb-3">
          <label>Role</label>
          <select v-model="role" class="form-control select2_init" name="role">
            <option value="">Select role</option>
            <option value="admin">admin</option>
            <option value="user">user</option>
          </select>
          <span v-if="error['role']" class="text-danger">{{
            error['role'][0]
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
      role: '',
      user: {
        name: '',
        email: '',
        password: '',
        title: '',
        gender: '',
        education: '',
        location: '',
        phone: '',
        skills: '',
        note: '',
        birthday: '',
        is_active: '',
      },
      selectFile: null,
      error: [],
    }
  },
  async mounted() {
    const res = await this.$axios.get(
      'admin/user/edit/' + this.$route.params.slug
    )
    // eslint-disable-next-line no-console
    console.log(res.data)
    // eslint-disable-next-line no-console
    console.log(res.data.role)
    this.role = res.data.role
    this.user = res.data.user
  },
  methods: {
    imageFile(event) {
      this.selectFile = event.target.files[0]
      // eslint-disable-next-line no-console
      console.log(this.selectFile)
    },
    async editUser() {
      const formData = new FormData()
      formData.append('avatar_url', this.selectFile)
      formData.append('name', this.user.name)
      formData.append('email', this.user.email)
      formData.append('password', this.user.password)
      formData.append('title', this.user.title)
      formData.append('gender', this.user.gender)
      formData.append('education', this.user.education)
      formData.append('location', this.user.location)
      formData.append('phone', this.user.phone)
      formData.append('skills', this.user.skills)
      formData.append('note', this.user.note)
      formData.append('birthday', this.user.birthday)
      formData.append('is_active', this.user.is_active)
      formData.append('role', this.role)
      await this.$axios
        .post('admin/user/update/' + this.user.id, formData)
        .then((res) => {
          // eslint-disable-next-line no-console
          console.log(res)
          if (res.status === 200) {
            this.$router.push(
              { name: 'admin-user' },
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
