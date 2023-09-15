<template>
    <div class="container mt-5 mx-auto">
        <h2>Remember password?</h2>
        <div class="row">
            <div class="px-lg-5 py-lg-5">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <div :class="{ error: v$.email.$errors.length }">
                        <input @blur="v$.email.$touch" v-model.trim="email" type="email" class="form-control" id="email" aria-describedby="emailFeedback" required>
                        <div class="input-errors text-danger" v-for="error of v$.email.$errors" :key="error.$uid">
                            <div class="error-msg">{{ error.$message }}</div>
                        </div>
                    </div>
                </div>


                <div class="mb-3">
                    <div class="form-text"><a href="#" >Sign up</a> for create new account.</div>

                    <div class="form-text">Have account? <a href="#">Sign in!</a></div>
                </div>

                <div class="text-center">
                    <button @click.prevent="rememberPassword" type="button" class="btn bg-info btn-lg my-4">Send</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import { required, email, minLength, maxLength } from '@vuelidate/validators'
import axios from 'axios';
export default {
    name: "ForgotPassword",

    setup(){
        return {
            v$: useVuelidate(),
        }
    },

    data(){
        return{
            email:null,
        }
    },

    validations(){
        return{
            email: {required, email, minLength:minLength(8), $lazy: true},
        }
    },

    methods:{
        async rememberPassword(){
            this.v$.$validate()
            if(!this.v$.$error){
                console.log('email', this.email);

                await axios.get('/api/aut/password/forgot', {
                    email: this.email
                })
                    .then(res =>{
                        console.log(res);
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    }
}
</script>

<style scoped>

</style>
