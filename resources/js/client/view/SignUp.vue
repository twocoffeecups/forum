<template>
    <div class="container mt-5 mx-auto">
        <h2>Sign up</h2>
        <div class="p-4 p-md-5">
            <form>
                <div class="row">
                    <div class="col-md-6 mb-4">

                        <div class="form-outline">
                            <label class="form-label" for="login">Login</label>
                            <div :class="{ error: v$.signUpForm.login.$errors.length }">
                                <input @blur="v$.signUpForm.login.$touch" v-model.trim="signUpForm.login" type="text" class="form-control" id="login" aria-describedby="loginFeedback" required>
                                <div class="input-errors text-danger" v-for="error of v$.signUpForm.login.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 mb-4">

                        <div class="form-outline">
                            <label class="form-label" for="sign-up-email">Email</label>
                            <div :class="{ error: v$.signUpForm.email.$errors.length }">
                                <input @blur="v$.signUpForm.email.$touch" v-model.trim="signUpForm.email" type="email" class="form-control" id="sign-up-email" aria-describedby="emailFeedback" required>
                                <div class="input-errors text-danger" v-for="error of v$.signUpForm.email.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">

                        <div class="form-outline">
                            <label class="form-label" for="firstName">First name</label>
                            <div :class="{ error: v$.signUpForm.firstName.$errors.length }">
                                <input @blur="v$.signUpForm.firstName.$touch" v-model.trim="signUpForm.firstName" type="text" class="form-control" id="firstName" aria-describedby="firstNameFeedback" required>
                                <div class="input-errors text-danger" v-for="error of v$.signUpForm.firstName.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 mb-4">

                        <div class="form-outline">
                            <label class="form-label" for="lastName">Last name</label>
                            <div :class="{ error: v$.signUpForm.lastName.$errors.length }">
                                <input @blur="v$.signUpForm.lastName.$touch" v-model.trim="signUpForm.lastName" type="text" class="form-control" id="lastName" aria-describedby="lastNameFeedback" required>
                                <div class="input-errors text-danger" v-for="error of v$.signUpForm.lastName.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                        <div class="form-outline">
                            <label class="form-label" for="phone">Phone</label>
                            <div :class="{ error: v$.signUpForm.phone.$errors.length }">
                                <input @blur="v$.signUpForm.phone.$touch" v-model.number="signUpForm.phone" pattern="[7-9]{1}[0-9]{9}" type="tel" id="phone" class="form-control" aria-describedby="phoneFeedback" required>
                                <div class="input-errors text-danger" v-for="error of v$.signUpForm.phone.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                        <div class="form-outline">
                            <label class="form-label" for="password">Password</label>
                            <div :class="{ error: v$.signUpForm.password.$errors.length }">
                                <input @blur="v$.signUpForm.password.$touch" v-model.trim="signUpForm.password" type="password" class="form-control" id="password" aria-describedby="passwordFeedback" required>
                                <div class="input-errors text-danger" v-for="error of v$.signUpForm.password.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 mb-4 pb-2">

                        <div class="form-outline">
                            <label class="form-label" for="confirmPass">Confirm password</label>
                            <div :class="{ error: v$.signUpForm.confirmPass.$errors.length }">
                                <input @blur="v$.signUpForm.confirmPass.$touch" v-model.trim="signUpForm.confirmPass" type="password" class="form-control" id="confirmPass" aria-describedby="passwordFeedback" required>
                                <div class="input-errors text-danger" v-for="error of v$.signUpForm.confirmPass.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-text">Have account? <a href="#">Sign in</a></div>

                    <div class="form-text">Forgot your password? <a href="#" data-bs-target="#forgot-pass-modal" data-bs-toggle="modal" data-bs-dismiss="modal">Create new!</a></div>
                </div>

                <div class="mt-2 pt-2">
                    <button @click.prevent="signUp" class="btn btn-info btn-lg" type="submit">Sign up</button>
                </div>

            </form>
        </div>
    </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import { required, email, minLength, maxLength, sameAs, } from '@vuelidate/validators'
import axios from "axios";
export default {
    name: "SignUp",

    setup(){
        return{
            v$: useVuelidate(),
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
                confirmPass: null,
                gender:null,
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
                confirmPass: {required, minLength:minLength(6), sameAs: sameAs(this.signUpForm.password), maxLength:maxLength(32), $lazy: true},
            },
        }
    },

    methods:{
        async signUp(){
            this.v$.$validate()
            if(!this.v$.$error) {
                let data = new FormData();

                for(let [key, value] of Object.entries(this.signUpForm)){
                    data.append(key, value)
                }

                await axios.post('/api/auth/sign-up', {data})
                    .then(res => {
                        console.log(res)
                        this.$router.push({name:'main'});
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
    }
}
</script>

<style scoped>

</style>
