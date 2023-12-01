import axios from "axios";
import {useToast} from "vue-toastification";

const toast = useToast();

export default {
    state:{
        userDetails:{},
        isLoginIn: false,
        online: false,
    },

    getters:{
        user(state){
            return state.userDetails;
        },

        isLoginIn(state){
            return state.isLoginIn;
        },

        isOnline(state){
            return state.online;
        }
    },

    actions:{
        register({dispatch}, user){
            return new Promise((resolve, reject) => {
                let data = new FormData();
                for(let [key, value] of Object.entries(user)){
                    data.append(key, value);
                }
                axios.post('/api/auth/sign-up', data)
                    .then(res => {
                        if(res.data){
                            this.$router.push({name:'auth.signIn'});
                            toast.success('You have successfully registered!');
                            resolve(res);
                        }else {
                            reject(res);
                        }

                    })
                    .catch(error => {
                        this.t$.error(error.message);
                        reject(error)
                    })
            })

        },

        login({dispatch}, user){
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/sign-in', {
                    email: user.email,
                    password: user.password
                })
                    .then(res => {
                        if(res.data){
                            toast.success('Login successfully!');
                            this.$router.push({name:'main'});
                            localStorage.setItem('access-token', res.data.accessToken);
                            resolve(res);
                        }else{
                            reject(res);
                        }

                    })
                    .catch(error => {
                        toast.error(error.message);
                        reject(error);
                    })
            });

        },

        forgotPassword({dispatch}, email){
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/password/forgot', {
                    email: email
                })
                    .then(res => {
                        if(res.data){
                            this.$router.push({name:'main'});
                            toast.info('An email was sent to the specified email address with a link to create a new password.');
                            resolve(res);
                        }else{
                            reject(res);
                        }
                    })
                    .catch(error => {
                        toast.error(error.message);
                        reject(error);
                    })
            });
        },

        resetPassword({dispatch}, user){
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/password/reset', {
                    email: user.email,
                    password: user.password,
                    confirmPassword: user.confirmPassword,
                    hash: user.hash
                })
                    .then(res => {
                        if(res.data){
                            toast.info('Password has been successfully changed. Sign in to your account.');
                            this.$router.push({name:'main'});
                            resolve(res);
                        }else{
                            reject(res);
                        }
                    })
                    .catch(error => {
                        toast.error('Error!');
                        reject(error);
                    })
            });
        },

        logout({dispatch}){
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/logout')
                    .then(res => {
                        if(res.data){
                            this.$router.push({name:'main'});
                            localStorage.removeItem('access-token');
                            resolve(res);
                        }else{
                            reject(res)
                        }
                    })
                    .catch(error => {
                        reject(error)
                    })
            });
        },
    }

}
