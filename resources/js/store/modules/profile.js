import axios from "axios";
import {useToast} from "vue-toastification";
import api from "../../api/api";

const toast = useToast();

export default {
    actions:{
        getUserDetails({dispatch}){
            return new Promise((resolve, reject) => {
                const id = JSON.parse(localStorage.getItem('user-details')).id
                api.get(`/api/client/profile`)
                    .then(res => {
                        if(res.data){
                            resolve(res);
                        }else {
                            reject(res);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },

        updateProfile({dispatch}, user){
            return new Promise((resolve, reject) => {
                let data = new FormData();
                data.append('_method', 'put')
                for(let [key, value] of Object.entries(user)){
                    data.append(key, value);
                }
                axios.post(`/api/client/${1}/profile/profile-update`, data)
                    .then(res => {
                        if(res.data){
                            toast.success('You have successfully registered!');
                            resolve(res);
                        }else{
                            reject(res);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? 'Error!');
                        reject(error);
                    })
            });
        },

        createNewPassword({dispatch}, user){
            return new Promise((resolve, reject) => {
                let data = new FormData();
                data.append('_method', 'put')
                for(let [key, value] of Object.entries(user)){
                    data.append(key, value);
                }
                axios.post(`/api/client/${1}/profile/edit-password`, data)
                    .then(res => {
                        if(res.data){
                            toast.success('Password update successfully!');
                            resolve(res);
                        }else{
                            reject(res);
                        }
                    })
                    .catch(error =>{
                        toast.error(error.response.data.message ?? 'Error!');
                        reject(error)
                    })


            });
        },

        updateAvatar({dispatch}, avatar){
            return new Promise((resolve, reject) => {
                let data = new FormData();
                data.append('avatar', avatar);
                data.append('_method', 'patch');
                axios.post(`/api/client/${1}/profile/update-avatar`, data)
                    .then(res => {
                        if(res.data){
                            toast.success(res.data.message);
                            resolve(res);
                        }else{
                            reject(res);
                        }

                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? 'Error!');
                        reject(error);
                    })
            });
        },
    },
}
