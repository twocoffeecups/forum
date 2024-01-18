import axios from "axios";
import router from "../router";
import store from "../store";

const token = localStorage.getItem('access-token');

const api = axios.create({
    headers:{
        Authorization: `Bearer ${token}`
    }
});

api.interceptors.response.use(
    (response) => {
        return Promise.resolve(response);
    },
    (error) => {
    if(error.response.status === 401 || error.response.status === 419){
        localStorage.removeItem('access-token');
        store.dispatch('auth/setLoggedInstate');
        router.push({name:'main'});
        //console.log(error)
    }
    return Promise.reject(error);
});

export default api;
