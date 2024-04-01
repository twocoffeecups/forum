<template>
    <div class="card rounded-0 mt-4 mb-4">
        <div class="card-header">{{ $t('view.editAccount.deleteAcc') }}</div>
        <div class="card-body">
            <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your
                account, select the button below.</p>
            <button @click.prevent="confirmDialog" class="btn btn-danger-soft text-danger" type="button">I understand,
                delete my account
            </button>
        </div>
    </div>

    <ConfirmDialog @confirmationEmit="deleteEmit"/>
</template>

<script>
import {useToast} from "vue-toastification";
import axios from "axios";
import ConfirmDialog from "./ConfirmDialog.vue";

export default {
    name: "DeleteAccountCard",
    components: {ConfirmDialog},
    emits: ['confirmationEmit'],

    setup() {
        return {
            t$: useToast(),
        }
    },

    data() {
        return {
            userId: 2,
        }
    },

    methods: {

        confirmDialog() {
            const confirmDialog = new bootstrap.Modal('#confirmModal');
            confirmDialog.show();
        },

        deleteEmit(data) {
            if (data) {
                this.deleteAccount()
            }
        },


        deleteAccount() {

            console.log('Account deleted');

            // axios.post(`/api/client/${this.userId}/profile/delete`)
            // .then(res => {
            //   console.log(res);
            // })
            // .catch(error => {
            //   console.log(error);
            // })
        }
    }
}
</script>

<style scoped>

</style>
