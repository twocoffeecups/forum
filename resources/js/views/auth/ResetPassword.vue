<template>

    <!-- Sign in form -->
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="logo">
                <img src="../../assets/img/logo.png" class="img-fluid" alt="Bootstrap" width="200">
              </div>

              <h3 class="h5 mt-5 mb-3 fw-bold">{{ $t('view.resetPassword.resetPass') }}</h3>

              <div class="mb-3 text-start">
                <p>{{ $t('view.resetPassword.creteNewPass') }}</p>
              </div>

              <div class="form-outline mb-4">
                <div :class="{ error: v$.user.email.$errors.length }">
                  <input @blur="v$.user.email.$touch" v-model.trim="user.email" type="email" :placeholder="$t('view.resetPassword.email')" class="form-control form-control-lg" id="email">
                  <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.user.email.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>
                </div>
              </div>

              <div class="form-outline mb-4">
                <div :class="{ error: v$.user.password.$errors.length }">
                  <input @blur="v$.user.password.$touch" type="password" v-model.trim="user.password" :placeholder="$t('view.resetPassword.newPass')" class="form-control form-control-lg" id="password">
                  <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.user.password.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>
                </div>
              </div>

              <div class="form-outline mb-4">
                <div :class="{ error: v$.user.confirmPassword.$errors.length }">
                  <input @blur="v$.user.confirmPassword.$touch" type="password" v-model.trim="user.confirmPassword" :placeholder="$t('view.resetPassword.confirmPass')" class="form-control form-control-lg" id="confirmPassword">
                  <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.user.confirmPassword.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>
                </div>
              </div>


              <div class="form-text mb-3">
                <p class="small"><router-link :to="{name:'auth.signUp'}">{{ $t('component.signIn.signUp') }}</router-link> for create new account.
                  {{ $t('component.signIn.forgotYouPass') }} <router-link :to="{name:'auth.forgotPassword'}">Create new!</router-link></p>
              </div>


              <div class="d-grid gap-2">
                <button class="btn btn-primary btn-lg bg-gradient" @click.prevent="resetPassword" type="submit">{{ $t('view.resetPassword.create') }}</button>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>

</template>

<script>
import {useVuelidate} from "@vuelidate/core";
import {maxLength, minLength, required, sameAs, email} from "@vuelidate/validators";
import {useToast} from "vue-toastification";
import axios from "axios";
export default {
  name: "ResetPassword",

  setup () {
    return {
      v$: useVuelidate(),
      t$: useToast(),
    }
  },

  data(){
    return{
        user:{
            email: null,
            password: null,
            confirmPassword: null,
            hash: this.$route.params.hash,
        },
    }
  },

  validations(){
    return{
        user:{
            email: {required, email, minLength:minLength(6), maxLength:maxLength(32), $lazy: true},
            password: {required, minLength:minLength(8), maxLength:maxLength(64), $lazy: true},
            confirmPassword: {required, minLength:minLength(8), sameAs: sameAs(this.user.password), maxLength:maxLength(64), $lazy: true},
        },
    }
  },

  methods:{
    async resetPassword(){
      this.v$.$validate()
      if(!this.v$.$error){
        this.$store.dispatch('resetPassword', this.user);
      }
    },
  }
}
</script>

<style scoped>

</style>
