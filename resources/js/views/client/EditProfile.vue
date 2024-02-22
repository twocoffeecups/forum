<template>
    <div class="row mx-auto">
        <div class="col-xl-4">
            <!-- Profile picture -->
            <EditAvatarCard/>

            <!-- Use notification -->
            <div class="card mt-4 mb-4">
                <div class="card-header"> Уведомления</div>
                <div class="card-body">
                    <p>Ходите ли вы чтобы уведомлдения приходили вам на электронную почту?</p>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">Включены | Выключены</label>
                    </div>
                </div>
            </div>

            <!-- Delete account -->
            <DeleteAccountCard/>
        </div>

        <div class="col-xl-8">
            <!-- Account details card-->
            <EditProfileCard/>

            <!-- Change password card-->
            <EditPasswordCard/>
        </div>
    </div>
</template>

<script>
import EditProfileCard from "../../components/client/EditProfileCard.vue";
import EditPasswordCard from "../../components/client/EditPasswordCard.vue";
import DeleteAccountCard from "../../components/client/DeleteAccountCard.vue";
import EditAvatarCard from "../../components/client/EditAvatarCard.vue";
import {mapGetters} from "vuex";

export default {
    name: 'EditAccount',
    components: {EditAvatarCard, DeleteAccountCard, EditPasswordCard, EditProfileCard},

    computed: {
        ...mapGetters({
            userDetails: 'auth/userDetails',
        })
    },

    // data(){
    //     return{
    //         userDetails: JSON.parse(localStorage.getItem('user-details')),
    //     }
    // },

}
</script>

<style scoped>

</style>
