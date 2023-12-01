<template>
  <div class="card mb-4">
    <div class="card-header">{{ $t('view.editAccount.changePass') }}</div>
    <div class="card-body">
      <form>
        <!-- Form Group (current password)-->
        <div class="mb-3">
          <label class="small mb-1" for="oldPassword">{{ $t('view.editAccount.currentPass') }}</label>
          <div :class="{ error: v$.user.oldPassword.$errors.length }">
            <input @blur="v$.user.oldPassword.$touch" v-model.trim="user.oldPassword" type="password" class="form-control form-control-lg" id="oldPassword">
            <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.user.oldPassword.$errors" :key="error.$uid">
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>
        <!-- Form Group (new password)-->
        <div class="mb-3">
          <label class="small mb-1" for="password">{{ $t('view.editAccount.newPass') }}</label>
          <div :class="{ error: v$.user.password.$errors.length }">
            <input @blur="v$.user.password.$touch" v-model.trim="user.password" type="password" class="form-control form-control-lg" id="password">
            <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.user.password.$errors" :key="error.$uid">
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>
        <!-- Form Group (confirm password)-->
        <div class="mb-3">
          <label class="small mb-1" for="confirmPassword">{{ $t('view.editAccount.confirmPass') }}</label>
          <div :class="{ error: v$.user.passwordConfirmation.$errors.length }">
            <input @blur="v$.user.passwordConfirmation.$touch" v-model.trim="user.passwordConfirmation" type="password" :placeholder="$t('component.signUp.confirmPass')" class="form-control form-control-lg" id="confirmPassword">
            <div class="input-errors my-2 text-danger small text-start" v-for="error of v$.user.passwordConfirmation.$errors" :key="error.$uid">
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>
        <button @click.prevent="updatePassword" class="btn btn-primary" type="button">{{ $t('view.editAccount.save') }}</button>
      </form>
    </div>
  </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import {required, minLength, maxLength, sameAs, } from '@vuelidate/validators'
import {useToast} from "vue-toastification";
import axios from "axios";
export default {
  name: "EditPasswordCard",

  setup(){
    return{
      v$: useVuelidate(),
      t$: useToast(),
    }
  },

  data(){
    return{
        user:{
            oldPassword: null,
            password: null,
            passwordConfirmation: null,
        },

    }
  },

  validations(){
    return{
        user:{
            oldPassword: {required, minLength:minLength(8), maxLength:maxLength(32), $lazy: true},
            password: {required, minLength:minLength(8), maxLength:maxLength(32), $lazy: true},
            passwordConfirmation: {required, minLength:minLength(6), sameAs: sameAs(this.user.password), maxLength:maxLength(32), $lazy: true},
        },

    }
  },


  methods:{
    async updatePassword(){
      this.v$.$validate();
      if(!this.v$.$error) {

        if(this.user.password === this.user.oldPassword){
          this.t$.error('Старый и новый пароль не должны совпадать.');
          return false;
        }
        this.$store.dispatch('createNewPassword', this.user)
        // await axios.post('/api/client/profile/password/update', {
        //   oldPassword: this.oldPassword,
        //   password: this.password,
        //   confirmPassword: this.confirmPassword,
        // })
        // .then(res => {
        //   console.log(res);
        // })
        // .catch(error => {
        //   console.log(error)
        // })

      }
    }
  }


}
</script>

<style scoped>

</style>
