<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
      <div class="container">
        <a class="navbar-brand" href="">
          <img
            src="/src/assets/images/logo-dark.png"
            class="card-logo card-logo-dark"
            alt="logo dark"
            height="25" />
        </a>
        <button
          class="navbar-toggler fs-24 text-body"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <i class="mdi mdi-menu"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div
            class="navbar-nav mx-auto mt-2 mt-lg-0"
            id="navbar-example"></div>
          <div class="">
            <router-link
              type="button"
              :to="{ name: 'Login' }"
              class="btn btn-success">
              <i class="ri-user-3-line align-bottom me-1"></i>
              Masuk
            </router-link>
          </div>
        </div>
      </div>
    </nav>
    <!-- end navbar -->
    <div
      class="vertical-overlay"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent.show"></div>
  </div>
</template>
<script>
export default {
  methods: {
    isActive(route) {
      return this.$route.path === route;
    },
  },
};
</script>
<style lang=""></style>
