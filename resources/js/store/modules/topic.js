import {useToast} from "vue-toastification";
import axios from "axios";

const toast = useToast();
export default {

    actions:{

        createTopic({dispatch}, data){
            return new Promise((resolve,reject) =>{
                console.log(data);
                axios.post(`/api/client/${1}/topic/`, data)
                    .then(res => {
                        if(res.data){
                            resolve(res);
                            toast.success('Topic created.');
                        }else{
                            reject(res);
                        }
                    })
                    .catch(error => {
                        reject(error);
                        toast.error("Error!");
                    })
            });
        },

    },

}
