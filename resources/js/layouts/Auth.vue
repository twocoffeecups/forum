<template>
    <div class="client-bg" :style="`background: url('${background.imageUrl}')`">

        <div class="container py-5 mx-auto my-auto">
            <div class="row d-flex justify-content-center align-items-center">

                <div class="col-12 col-md-8 col-lg-6 col-xl-5 mx-auto">

                    <div class="card shadow-2-strong bg-gradient" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="logo">
<!--                                <img src="../../assets/img/logo.png" class="img-fluid" alt="Bootstrap" width="200">-->
                                <img v-if="logo" :src="logo.imageUrl ?? '../../assets/img/logo.png'" class="img-fluid" alt="Bootstrap" width="200">
                            </div>

                            <RouterView/>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "Auth",

    computed: {
        ...mapGetters({
            background: 'forumSettings/getBackground',
            logo: 'forumSettings/getLogo',
        })
    }
}
</script>

<style scoped>

</style>
