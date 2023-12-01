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

              <h3 class="h5 mt-5 mb-3 fw-bold">{{ $t('component.forgotPassword.forgotPassword') }}</h3>

              <div class="mb-3 text-start">
                <label for="email" class="form-label">Enter your email to get a link to reset your password.</label>
              </div>

              <div class="form-outline mb-4">
                <div :class="{ error: v$.email.$errors.length }">
                  <input @blur="v$.email.$touch" v-model.trim="email" type="email" :placeholder="$t('component.forgotPassword.email')" class="form-control form-control-lg" id="email">
                  <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.email.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>
                </div>
              </div>


              <div class="form-text mb-3">
                <p class="small"><router-link :to="{name:'auth.signUp'}">{{ $t('component.forgotPassword.signUp') }}</router-link> {{ $t('component.forgotPassword.createNewAcc') }}
                  Have account? <router-link :to="{name:'auth.signIn'}">{{ $t('component.forgotPassword.signIn') }}</router-link></p>
              </div>


              <div class="d-grid gap-2">
                <button class="btn btn-primary btn-lg bg-gradient" @click.prevent="forgotPassword" type="submit">{{ $t('component.forgotPassword.forgot') }}</button>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>

</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import {required, email, minLength, maxLength} from '@vuelidate/validators'
import {useToast} from "vue-toastification";
import axios from "axios";
export default {
  name: "ForgotPassword",

  setup () {
    return {
      v$: useVuelidate(),
      t$: useToast(),
    }
  },

  data(){
    return{
      email:null,
    }
  },

  validations(){
    return{
      email:{required, email, minLength:minLength(8), maxLength:maxLength(32), $lazy: true},
    }
  },

  methods:{

    forgotPassword(){
      this.v$.$validate();
      if(!this.v$.$error){
        this.$store.dispatch('forgotPassword', this.email);
      }
    }

  },
}
</script>

<style scoped>

</style>