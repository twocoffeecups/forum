<template>

  <!-- Header -->
  <Header />
  <!-- ./ Header -->

  <!-- Sidebar -->
  <Sidebar />
  <!-- ./ Sidebar -->

  <!-- Main -->
  <PageContent />

</template>

<script>
import Sidebar from "../components/admin/Sidebar.vue";
import Footer from "../components/admin/Footer.vue";
import Header from "../components/admin/Header.vue";

import PageContent from "../components/admin/PageContent.vue";
export default {
  name: "Admin",
  components: {PageContent, Header, Footer, Sidebar}
}
</script>

<style scoped>
@import "../assets/admin.css";
</style>
