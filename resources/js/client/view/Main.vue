<template>
    <div class="container mt-5 mx-auto">
        <h2>Client main view</h2>
        <div>
            <div class="mb-2">
                <button @click="signUp" class="btn btn-primary">Sign up</button>
            </div>
            <div class="mb-2">
                <button @click="signIn" class="btn btn-primary">Sign in</button>
            </div>
            <div class="mb-2">
                <button @click="logout" class="btn btn-primary">Logout</button>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "Main",

    data(){
        return{
            token: null,
            user: null,
        }
    },

    methods:{
        signUp(){
            let data = new FormData();

            data.append('login', 'aximand');
            data.append('lastName', 'Horus');
            data.append('firstName', 'Aximand');
            data.append('email', 'aximand@gmail.ru');
            data.append('password', '12345678');
            data.append('passwordConfirmation', '12345678');
            data.append('phone', '+7889123456');

            axios.post('/api/client/auth/sign-up', data)
            .then(res => {
                console.log(res)
            })
            .catch(error => {
                console.log(error);
            })
        },

        signIn(){
            axios.post('/api/client/auth/sign-in', {
                email: 'aximand@gmail.ru',
                password: '12345678',
            })
                .then(res => {
                    console.log(res)
                    this.token = res.data.token
                    this.user = res.data.user
                })
                .catch(error => {
                    console.log(error);
                })
        },

        logout(){
            axios.post('/api/client/auth/logout',{}, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
                .then(res => {
                    console.log(res)
                    this.token = null
                    this.user = null
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>

<style scoped>

</style>
