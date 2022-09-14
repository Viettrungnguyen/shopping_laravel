<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30">
                            <img
:src="`http://localhost:8000${user.avatar_url}`" class="rounded-circle"
                                width="150" />
                            <h4 class="card-title m-t-10">{{ $auth.user.name }}</h4>
                        </center>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <form action="" class="form-horizontal form-material mx-2" @submit.prevent="changePassword">
                            <div class="form-group">
                                <label class="col-md-12">Old Password</label>
                                <div class="col-md-12">
                                    <input
v-model="password.oldpassword" type="password"
                                        placeholder="Enter old passowrd" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">New Password</label>
                                <div class="col-md-12">
                                    <input
v-model="password.password" type="password" placeholder="Enter new password"
                                        class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Confirm Password </label>
                                <div class="col-md-12">
                                    <input
v-model="password.password_confirmation" type="password"
                                        class="form-control form-control-line"
                                        placeholder="Enter password confirmation">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success text-white">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material mx-2" action="" @submit.prevent="updateProfile">
                            <div class="form-group">
                                <label class="col-md-12">Name</label>
                                <div class="col-md-12">
                                    <input v-model="user.name" type="text" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input v-model="user.email" type="email" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Avatar</label>
                                <div class="col-md-12">
                                    <input id="avatar" class="form-control" type="file" @change="imageFile">
                                    <input v-model="user.avatar_url" type="text" name="avatar" hidden>
                                    <div id="preview">
                                        <img v-if="user.avatar_url" :src="`http://localhost:8000${user.avatar_url}`" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Title</label>
                                <div class="col-md-12">
                                    <input v-model="user.title" type="text" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">{{ user.gender }}</label>
                                <div class="col-sm-12">
                                    <select v-model="user.gender" class="form-select shadow-none form-control-line">
                                        <option value="nam">Nam</option>
                                        <option value="nữ">Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Education</label>
                                <div class="col-md-12">
                                    <input v-model="user.education" type="text" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Location</label>
                                <div class="col-md-12">
                                    <input v-model="user.location" type="text" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">phone</label>
                                <div class="col-md-12">
                                    <input v-model="user.phone" type="text" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">skills</label>
                                <div class="col-md-12">
                                    <input v-model="user.skills" type="text" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">note</label>
                                <div class="col-md-12">
                                    <textarea
v-model="user.note" rows="5"
                                        class="form-control form-control-line"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">birthday</label>
                                <div class="col-md-12">
                                    <input v-model="user.birthday" type="date" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success text-white">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import swal from 'sweetalert2'
export default {
    data() {
        return {
            password: {
                oldpassword: '',
                password: '',
                password_confirmation: ''
            },
            user: {
                name: '',
                email: '',
                title: '',
                gender: '',
                education: '',
                location: '',
                phone: '',
                skills: '',
                note: '',
                birthday: '',
            },
            selectFile: null
        }
    },

    mounted() {
        this.asyncData()
    },

    methods: {
        async asyncData() {
            const res = await this.$axios.get('admin/profile/edit/' + this.$auth.user.id)
            this.user = res.data
        },

        async changePassword() {
            await this.$axios.post('admin/profile/change-password/' + this.$auth.user.id,
                {
                    oldpassword: this.password.oldpassword,
                    password: this.password.password,
                    password_confirmation: this.password.password_confirmation
                }
            ).then((res) => {
                // eslint-disable-next-line no-console
                console.log(res)
                if (res.status === 200) {
                    this.$router.push({ name: 'admin-category' },
                        swal({
                            title: `change password thành công`,
                            buttonsStyling: false,
                            confirmButtonClass: 'btn btn-success btn-fill'
                        })
                    )
                }
            })
        },

        imageFile(event) {
            this.selectFile = event.target.files[0]
            // eslint-disable-next-line no-console
            console.log(this.selectFile);
        },

        async updateProfile() {
            const formData = new FormData()
            formData.append('avatar_url', this.selectFile)
            formData.append('name', this.user.name)
            formData.append('email', this.user.email)
            formData.append('title', this.user.title)
            formData.append('gender', this.user.gender)
            formData.append('education', this.user.education)
            formData.append('location', this.user.location)
            formData.append('phone', this.user.phone)
            formData.append('skills', this.user.skills)
            formData.append('note', this.user.note)
            formData.append('birthday', this.user.birthday)
            await this.$axios.post('admin/profile/update/' + this.user.id,
                formData,
            ).then((res) => {
                // eslint-disable-next-line no-console
                console.log(res)
                if (res.status === 200) {
                    this.asyncData()
                    swal({
                        title: `Cập nhật thành công`,
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-success btn-fill'
                    })
                }
                // eslint-disable-next-line no-console
                console.log("result", res)
            })
        }
    }
}
</script>