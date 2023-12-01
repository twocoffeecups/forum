<template>

    <!-- Sign in form -->
    <div class="container py-4">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="logo">
                <img src="../../assets/img/logo.png" class="img-fluid" alt="Bootstrap" width="200">
              </div>

              <h3 class="h5 mt-5 mb-3 fw-bold">{{ $t('component.signUp.signUp') }}</h3>

              <div class="form-outline mb-4">
                <div :class="{ error: v$.signUpForm.login.$errors.length }">
                  <input @blur="v$.signUpForm.login.$touch" v-model.trim="signUpForm.login" type="text" :placeholder="$t('component.signUp.login')" class="form-control form-control-lg" id="login">
                  <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.signUpForm.login.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>
                </div>
              </div>

              <div class="form-outline mb-4">
                <div :class="{ error: v$.signUpForm.firstName.$errors.length }">
                  <input @blur="v$.signUpForm.firstName.$touch" v-model.trim="signUpForm.firstName" type="text" :placeholder="$t('component.signUp.firstName')" class="form-control form-control-lg" id="firstName">
                  <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.signUpForm.firstName.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>
                </div>
              </div>

              <div class="form-outline mb-4">
                <div :class="{ error: v$.signUpForm.lastName.$errors.length }">
                  <input @blur="v$.signUpForm.lastName.$touch" v-model.trim="signUpForm.lastName" type="text" :placeholder="$t('component.signUp.lastName')" class="form-control form-control-lg" id="lastName">
                  <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.signUpForm.lastName.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>
                </div>
              </div>

              <div class="form-outline mb-4">
                <div :class="{ error: v$.signUpForm.email.$errors.length }">
                  <input @blur="v$.signUpForm.email.$touch" v-model.trim="signUpForm.email" type="email" :placeholder="$t('component.signUp.email')" class="form-control form-control-lg" id="email">
                  <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.signUpForm.email.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>
                </div>
              </div>

              <div class="form-outline mb-4">
                <div :class="{ error: v$.signUpForm.phone.$errors.length }">
                  <input @blur="v$.signUpForm.phone.$touch" v-model.trim="signUpForm.phone" type="tel" :placeholder="$t('component.signUp.phone')" class="form-control form-control-lg" id="phone">
                  <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.signUpForm.phone.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>
                </div>
              </div>

              <div class="form-outline mb-4">
                <div :class="{ error: v$.signUpForm.password.$errors.length }">
                  <input @blur="v$.signUpForm.password.$touch" v-model.trim="signUpForm.password" type="password" :placeholder="$t('component.signUp.password')" class="form-control form-control-lg" id="password">
                  <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.signUpForm.password.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>
                </div>
              </div>

              <div class="form-outline mb-4">
                <div :class="{ error: v$.signUpForm.passwordConfirmation.$errors.length }">
                  <input @blur="v$.signUpForm.passwordConfirmation.$touch" v-model.trim="signUpForm.passwordConfirmation" type="password" :placeholder="$t('component.signUp.confirmPass')" class="form-control form-control-lg" id="confirmPassword">
                  <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.signUpForm.passwordConfirmation.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>
                </div>
              </div>


              <div class="form-text mb-3">
                <p class="small">Have account? <router-link :to="{name:'auth.signIn'}">{{ $t('component.signIn.signIn') }}</router-link>.
                  {{ $t('component.signIn.forgotYouPass') }} <router-link :to="{name:'auth.forgotPassword'}">Create new!</router-link></p>
              </div>


              <div class="d-grid gap-2">
                <button class="btn btn-primary btn-lg bg-gradient" @click.prevent="signUp" type="submit">{{ $t('component.signUp.signUp') }}</button>
              </div>

              <hr class="my-4">

              <div class="d-grid gap-2">
                <button class="btn btn-lg border-0 btn-block btn-primary mb-2 bg-gradient" style="background-color: #dd4b39;"
                        type="submit"><i class="fab fa-yandex-international me-2"></i>Sign in with Yandex</button>

                <button class="btn btn-lg border-0 btn-block btn-primary bg-gradient" style="background-color:  #3b5998;"
                        type="submit"><i class="fab fa-google me-2"></i> Sign in with google</button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>


</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import { required, email, minLength, maxLength, sameAs, } from '@vuelidate/validators'
import {useToast} from "vue-toastification";
import axios from "axios";
export default {
  name: "SignUp",

  setup () {
    return {
      v$: useVuelidate(),
      t$: useToast(),
    }
  },


  data(){
    return{
      signUpForm:{
        login:null,
        email:null,
        firstName: null,
        lastName: null,
        phone: null,
        password: null,
        passwordConfirmation: null,
      },
    }
  },

  validations(){
    return{
      signUpForm:{
        login: {required, minLength:minLength(6), maxLength:maxLength(32), $lazy: true},
        email:{required, email, minLength:minLength(8), maxLength:maxLength(32), $lazy: true},
        firstName: {required, minLength:minLength(2), maxLength:maxLength(32), $lazy: true},
        lastName: {required, minLength:minLength(2), maxLength:maxLength(32), $lazy: true},
        phone: {minLength:minLength(9), maxLength:maxLength(13), $lazy: true},
        password: {required, minLength:minLength(8), maxLength:maxLength(32), $lazy: true},
        passwordConfirmation: {required, minLength:minLength(6), sameAs: sameAs(this.signUpForm.password), maxLength:maxLength(32), $lazy: true},
      },
    }
  },

  methods:{
    signUp(){
      this.v$.$validate();
      if(!this.v$.$error){
          this.$store.dispatch('register', this.signUpForm);
      }
    },
  }
}
</script>

<style scoped>

</style>
