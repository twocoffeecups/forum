<template>

    <div class="dropdown w-100 mx-1" v-if="user">
      <a class="nav-link dropdown-toggle-split d-flex" href="#" id="offcanvas-profile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://w7.pngwing.com/pngs/980/886/png-transparent-male-portrait-avatar-computer-icons-icon-design-avatar-flat-face-icon-people-head-cartoon.png" alt="mdo" width="32" height="32" class="rounded-circle">
        <span class="d-sm-block mx-3 d-md-block d-lg-none">User profile</span>
      </a>
      <ul class="dropdown-menu dropdown-profile" aria-labelledby="offcanvas-profile">
        <li data-bs-dismiss="offcanvas">
          <router-link class="dropdown-item" :to="{name:'profile.detail'}"><i class="fas fa-user-circle mx-2"></i> {{ $t('component.profileDropdown.profile') }}</router-link>
        </li>
        <li>
          <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt mx-2"></i> {{ $t('component.profileDropdown.logout') }}</a>
        </li>
      </ul>
    </div>

  <SignInButton v-if="!user" />

</template>

<script>
import SignInButton from "./SignInButton.vue";
export default {
  name: "ProfileDropdown",
  components: {SignInButton},
  data(){
    return{
      user: false,
    }
  }
}
</script>

<style scoped>
@media screen and (max-width: 960px) or (max-width: 1200px){
  .dropdown-profile{
    border: none;
  }
}

@media screen and (max-width: 1200px){
  .dropdown-profile{
    border: none;
  }
}
</style>