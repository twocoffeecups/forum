import axios from "axios";
import router from "../router/forum";
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
        //store.dispatch('auth/logout');
        router.push({name:'main'});
    }
    return Promise.reject(error);
});

export default api;
