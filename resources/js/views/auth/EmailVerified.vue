<template>
    <div class="my-5">
        <h3>Verify email. Pleas wait...</h3>
    </div>
</template>

<script>
import axios from "axios";
import {useToast} from "vue-toastification";
export default {
    name: "EmailVerified",

    setup() {
        return {
            t$: useToast(),
        }
    },

    mounted() {
        this.verifyMail();
    },

    methods: {
        verifyMail(){
            axios.get(`/api/auth/email/verify/${this.$route.params.id}/${this.$route.params.hash}`)
                .then(response => {
                    this.$router.push({name:'profile.details'})
                    this.t$.success(response.data.message ?? "Email verified.");
                    console.log("RESPONSE: ", response);
                })
                .catch(error => {
                    this.$router.push({name:'profile.details'})
                    this.t$.error(error.response.data.message ?? "Error.");
                    console.log(error);
                })
        },
    }
}
</script>

<style scoped>

</style>
