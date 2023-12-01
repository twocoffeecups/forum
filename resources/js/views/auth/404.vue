<template>

    <!-- Sign in form -->
    <div class="container py-5 mx-auto my-auto">
      <div class="row d-flex justify-content-center align-items-center">

        <div class="col-12 col-md-8 col-lg-6 col-xl-5 mx-auto">

          <div class="card shadow-2-strong bg-gradient" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="logo">
                <img src="../../assets/img/logo.png" class="img-fluid" alt="Bootstrap" width="200">
              </div>

              <h3 class="h3 mt-5 mb-3 fw-bold">404</h3>

              <div class="mb-2">
                <p>Error!. Page not found.</p>
              </div>

              <div class="mb-2">
                <router-link :to="{ name:'main.index' }">Back to site.</router-link>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

</template>

<script>
export default {
  name: "404",
}
</script>

<style scoped>

</style>