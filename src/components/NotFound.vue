<template>
    <!-- auth-page wrapper -->
    <div
        class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100"
    >
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden p-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="text-center">
                            <img
                                src="/src/assets/images/error400-cover.png"
                                alt="error img"
                                class="img-fluid"
                            />
                            <div class="mt-3">
                                <h3 class="">
                                    Maaf! Halaman tidak ditemukan 😭
                                </h3>
                                <p class="text-muted mb-4">
                                    Halaman yang Anda cari tidak tersedia!
                                </p>
                                <button @click="goBack" class="btn btn-success">
                                    <i class="mdi mdi-home me-1"></i> Back to
                                    Home
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth-page content -->
    </div>
    <!-- end auth-page-wrapper -->
</template>

<script setup>
import { useRouter } from "vue-router";

const router = useRouter();

const goBack = () => {
    router.go(-1);
};
</script>
