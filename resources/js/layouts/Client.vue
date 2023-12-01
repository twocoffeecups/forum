<template>
  <div class="client-bg">
    <Header />
    <div class="page-body">
      <router-view />
    </div>

    <Footer />
  </div>

</template>

<script>
import Header from "../components/client/Header.vue";
import Footer from "../components/client/Footer.vue";
export default {
  name: "Client",
  components: {Footer, Header},
}
</script>

<style scoped>
.page-body{
  padding-top: 50px;
}

.client-bg{
  display: flex;
  flex-direction: column;
}
</style>