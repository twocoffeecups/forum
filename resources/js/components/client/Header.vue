<template>
    <nav class="navbar navbar-expand-lg  bg-body-tertiary" style="background: #f7f7f7">
        <div class="container py-3">
            <a class="navbar-brand" href="#">
                <img v-if="logo.imageUrl" :src="logo.imageUrl" class="img-fluid" alt="Logo" width="125" height="45">
                <img v-if="!logo.imageUrl" src="../../assets/img/logo.png" class="img-fluid" alt="Logo" width="125" height="50">
                <span v-if="!showOnlyLogo" class="mx-4 my-auto h4 fw-bold">{{ forumName }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg"
                    aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start offcanvas-lg" tabindex="-1" id="navbarOffcanvasLg"
                 aria-labelledby="navbarOffcanvasLgLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body justify-content-end">

                    <ul class="navbar-nav my-auto justify-content-end align-items-start align-items-lg-end align-items-md-start align-items-lg-center align-items-sm-start pe-3"
                        style="height: 100%;">

                        <li class="nav-item" data-bs-dismiss="offcanvas">
                            <router-link class="nav-link d-flex align-items-center" aria-current="page"
                                         :to="{name:'main'}">
                                <i class="fas fa-home mx-2 d-sm-block d-md-block d-lg-none d-xl-none d-flex"></i>
                                {{ $t('component.header.main') }}
                            </router-link>
                        </li>

                        <li class="nav-item" data-bs-dismiss="offcanvas">
                            <a class="nav-link d-flex align-items-center" aria-current="page"
                                         href="#">
                                <i class="fas fa-home mx-2 d-sm-block d-md-block d-lg-none d-xl-none d-flex"></i>
                                About
                            </a>
                        </li>


                        <li class="nav-item">
                            <SearchButton/>
                        </li>

                        <li class="nav-item">
                            <NotificationsList v-if="isLoggedIn"/>
                        </li>

                        <li class="nav-item w-100">
                            <ProfileDropdown/>
                        </li>

                        <li class="nav-item d-flex w-100 mt-auto mt-lg-0 mt-md-auto mt-sm-auto flex-row  justify-content-between justify-content-center  justify-content-md-between justify-content-lg-center justify-content-xl-center align-items-center">

                            <LanguageSwitcher/>

                            <!-- TODO: сделать переключение тёмной/светлой темы -->
<!--                            <div class="d-flex align-items-center justify-content-center mx-2">-->
<!--                                <i class="fas fa-sun" v-if="theme" @click="theme=!theme" role="button"-->
<!--                                   style="font-size: 1.3em;"></i>-->
<!--                                <i class="fas fa-moon" v-if="!theme" @click="theme=!theme" role="button"-->
<!--                                   style="font-size: 1.3em;"></i>-->
<!--                            </div>-->

                        </li>
                    </ul>


                </div>
            </div>
        </div>
    </nav>

</template>

<script>
import NotificationsList from "./NotificationsList.vue";
import ProfileDropdown from "./ProfileDropdown.vue";
import LanguageSwitcher from "./LanguageSwitcher.vue";
import SearchButton from "./SearchButton.vue";
import {mapGetters} from "vuex";
import api from "../../api/api";

export default {
    name: "Header",
    components: {
        SearchButton, LanguageSwitcher, ProfileDropdown, NotificationsList,
    },

    data() {
        return {
            user: false,
            theme: false,
        }
    },

    computed: {
        selectedTheme() {
            return this.theme === true ? 'Dark' : 'Light'
        },
        ...mapGetters({
            forumName: 'forumSettings/getForumName',
            isLoggedIn: 'auth/isLoggedIn',
            logo: 'forumSettings/getLogo',
            showOnlyLogo: 'forumSettings/getShowOnlyLogo',
        })
    },
}
</script>

<style scoped>
.offcanvas {
    max-width: 70%;
}

@media screen and (max-width: 1200px) {
    .navbar {
        font-size: 1.5em;
    }
}

@media screen and (max-width: 480px) {
    .navbar {
        font-size: 1.2em;
    }
}
</style>
