import axios from "axios";
import {useToast} from "vue-toastification";
import router from '../../router';

const toast = useToast();

export default {
    state:{
        userDetails:{},
        isLoggedIn: false,
    },

    getters:{
        user(state){
            return state.userDetails;
        },

        isLoggedIn(state){
            return state.isLoggedIn;
        },

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
                            router.push({name:'auth.signIn'});
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

        login({dispatch, commit}, user){
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/sign-in', {
                    email: user.email,
                    password: user.password
                })
                    .then(res => {
                        if(res.data){
                            toast.success('Login successfully!');
                            localStorage.setItem('access-token', res.data.accessToken);
                            commit('setLoggedIn', true);
                            router.push({name:'main'});
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
                            router.push({name:'main'});
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
                            router.push({name:'main'});
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

        logout({dispatch, commit }){
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/logout',{}, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('access-token')}`
                    }
                })
                    .then(res => {
                        if(res.data){
                            localStorage.removeItem('access-token');
                            commit('setLoggedIn', false);
                            toast.success("You have successfully logout.")
                            router.push({name:'main'});
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

        setLoggedInstate(ctx){
            return new Promise((resolve,reject) => {
                if(localStorage.getItem('access-token')){
                    ctx.commit('setLoggedIn', true);
                    router.push({name:'main'});
                    resolve(true);
                }else{
                    ctx.commit('setLoggedIn', false);
                    resolve(false);
                }
            });
        },
    },

    mutations:{
        setLoggedIn(state, payload){
            state.isLoggedIn = payload;
        },
    },

}
