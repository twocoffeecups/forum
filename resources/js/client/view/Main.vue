<template>
    <div class="container mt-5 mx-auto">
        <h2>Client main view</h2>
        <div>
            <div class="mb-2">
                <button @click.prevent="signUp" class="btn btn-primary">Sign up</button>
            </div>
            <div class="mb-2">
                <button @click.prevent="signIn" class="btn btn-primary">Sign in</button>
            </div>
            <div class="mb-2">
                <button @click.prevent="logout" class="btn btn-primary">Logout</button>
            </div>

            <div class="mb-2">
                <button @click.prevent="getCategory" class="btn btn-primary">Get categories</button>
            </div>

        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Main",

    data(){
        return{
            token: null,
            user: null,
        }
    },

    mounted() {
        //this.getCategory()
    },

    methods:{
        signUp(){
            let data = new FormData();

            data.append('login', 'aximand');
            data.append('lastName', 'Horus2');
            data.append('firstName', 'Aximand2');
            data.append('email', 'aximand@gmail.ru');
            data.append('password', '12345678');
            data.append('passwordConfirmation', '12345678');
            data.append('phone', '+7889122319');

            axios.get('/sanctum/csrf-cookie')
                .then(response => {
                    axios.post('/register', data)
                        .then(res => {
                            console.log(res)
                        })
                        .catch(err => {
                            console.log(err.response);
                        })
                })
                .catch(error => {
                    console.log(error.response)
                })
        },

        signIn(){
            axios.get('/sanctum/csrf-cookie')
                .then(response => {
                    axios.post('/login', {
                        email: 'aximand@gmail.ru',
                        password: '12345678',
                    })
                        .then(res => {
                            console.log('Result: ',res)
                        })
                        .catch(error => {
                            console.log(error.response);
                        })
            });
        },

        logout(){
            axios.post('/logout')
                .then(res => {
                    console.log(res)
                    this.$router.push({name:'main'});
                })
                .catch(error => {
                    console.log(error.response);
                })
        },



        getCategory(){
            axios.get('/api/admin/forum/category/')
            .then(res => {
                console.log('Categories: ', res)
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
}
</script>

<style scoped>

</style>
