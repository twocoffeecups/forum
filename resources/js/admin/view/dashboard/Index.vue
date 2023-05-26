<template>
    <div class="hold-transition sidebar-mini">
        <div class="wrapper">

            <!-- Navbar -->
            <Navbar />
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <Sidebar />

            <!-- Content Wrapper. Contains page content -->
            <router-view />
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <Footer />
        </div>
    </div>



</template>

<script>
import Header from "../../../admin/component/Header.vue";
import Navbar from "../../component/Navbar.vue";
import Sidebar from "../../component/Sidebar.vue";
import Footer from "../../component/Footer.vue";
export default {
    name: "Index",
    components: {Footer, Sidebar, Navbar, Header}
}
</script>

<style scoped>

</style>
