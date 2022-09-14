<template>
    <div class="container">
        <div class="row col-12 mx-auto">
        <list-user></list-user>
    </div>
    </div>
</template>
<script>
import listUser from "~/components/partials/admin/content/user/list-user.vue";
export default {
    components: {
        listUser
    },
    layout: 'admin'
}
</script>