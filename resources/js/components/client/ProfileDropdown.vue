<template>

    <div class="dropdown w-100 mx-1" v-if="isLoggedIn">
        <a class="nav-link dropdown-toggle-split d-flex" href="#" id="offcanvas-profile" role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <img
                :src="avatar ?? 'storage/app/public/default/default-avatar.png'"
                alt="mdo" width="32" height="32" class="rounded-circle">
            <span class="d-sm-block mx-3 d-md-block d-lg-none">User profile</span>
        </a>
        <ul class="dropdown-menu dropdown-profile" aria-labelledby="offcanvas-profile">
            <li data-bs-dismiss="offcanvas">
                <router-link class="dropdown-item" :to="{name:'profile.details'}"><i class="fas fa-user-circle mx-2"></i>
                    {{ $t('component.profileDropdown.profile') }}
                </router-link>
            </li>
            <li>
                <a @click.prevent="logout" class="dropdown-item" href="#"><i class="fas fa-sign-out-alt mx-2"></i>
                    {{ $t('component.profileDropdown.logout') }}</a>
            </li>
        </ul>
    </div>

    <SignInButton v-if="!isLoggedIn"/>

</template>

<script>
import SignInButton from "./SignInButton.vue";
import {mapGetters} from "vuex";

export default {
    name: "ProfileDropdown",
    components: {SignInButton},

    computed:{
        ...mapGetters({
            isLoggedIn: 'auth/isLoggedIn',
            avatar: "auth/avatar",
        }),
    },

    data() {
        return {
            user: false,
        }
    },

    methods:{
        logout(){
            this.$store.dispatch('auth/logout');
        },
    },
}
</script>

<style scoped>
@media screen and (max-width: 960px) or (max-width: 1200px) {
    .dropdown-profile {
        border: none;
    }
}

@media screen and (max-width: 1200px) {
    .dropdown-profile {
        border: none;
    }
}
</style>
