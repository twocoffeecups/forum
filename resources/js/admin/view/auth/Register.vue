<template>
    <div class="hold-transition login-page">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>Admin</b>Dashboard</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Register a new membership</p>

                    <div class="mb-3">
                        <div :class="{ error: v$.login.$errors.length }">
                            <input @blur="v$.login.$touch" type="text" v-model="login" class="form-control" placeholder="Login">
                            <div class="input-errors" v-for="error of v$.login.$errors" :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="First name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Last name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button @click="signUp" type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>

                    <router-link :to="{name:'admin.login'}" class="text-center">I already have a membership</router-link>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
    </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, maxLength, } from '@vuelidate/validators'
import axios from "axios";
export default {
    name: "Register",

    setup(){
        return{
            v$: useVuelidate()
        }
    },

    data(){
        return{
            login:null,
            email:null,
            firstName:null,
            lastName:null,
            password:null,
            passwordConfirmation: null,
        }
    },

    validations(){
        return{
            login: {required, minLength:minLength(3), maxLength:maxLength(32), $lazy: true},
        }
    },

    methods:{

        signUp(){
            this.v$.$validate();
            if(!this.v$.$error){
                console.log('Sign Up');
            }else{
                console.log('Error');
            }

        }
    }
}
</script>

<style scoped>

</style>
