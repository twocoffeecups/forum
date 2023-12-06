import axios from "axios";
import router from "../router";

const token = localStorage.getItem('access-token');

const api = axios.create({
    headers:{
        Authorization: `Bearer ${token}`
    }
});

api.interceptors.response.use(
    (response) => {
        console.log(response);
        return Promise.resolve(response);
    },
    (error) => {
    if(error.response.status === 401 || error.response.status === 419){
        localStorage.removeItem('access-token');
    }
    return Promise.reject(error);
})

export default api;
