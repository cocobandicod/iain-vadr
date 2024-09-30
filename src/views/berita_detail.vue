<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import api from "../api";
import { formatTanggalsaja, truncateText } from "../utils/globalFunctions";
import GlobalFooter from "../components/footer.vue";

const route = useRoute();
const berita = ref(null);
const isLoading = ref(true);

const fetchDataBerita = async () => {
    isLoading.value = true;
    try {
        const response = await api.get(`/api/berita/${route.params.slug}`);
        berita.value = response.data.data;
    } catch (error) {
        console.error("Error fetching berita data:", error);
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchDataBerita();
});
</script>

<template>
    <section class="section bg-light">
        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h3 class="mb-3 fw-semibold">Berita</h3>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-lg-10 gy-8">
                    <div v-if="isLoading" class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div
                        v-else-if="!berita"
                        class="alert alert-danger text-center"
                        role="alert"
                    >
                        Berita tidak ditemukan
                    </div>
                    <div v-else class="col-lg-12 card pt-0 pb-0 mb-2 mt-2">
                        <div class="row p-3">
                            <div class="col-lg-12 pb-3">
                                <img
                                    :src="berita.image"
                                    class="img-fluid rounded"
                                    alt="Responsive image"
                                />
                            </div>
                            <div class="col-lg-12">
                                <h2>{{ berita.judul_berita }}</h2>
                                <p class="text-muted fs-13 mb-0 mt-2">
                                    <i class="ri-calendar-todo-fill me-1"></i>
                                    {{ formatTanggalsaja(berita.tgl_berita) }}
                                    {{ berita.jam_berita }}
                                    <i
                                        class="ri-account-circle-line ms-2 me-1"
                                    ></i>
                                    {{ berita.user.name }}
                                </p>
                                <p class="text-muted my-3 ff-secondary">
                                    {{ berita.isi_berita }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
        <!-- end container -->
    </section>

    <!-- Start footer -->
    <GlobalFooter />
    <!-- end footer -->
</template>
<script>
export default {
    name: "BeritaDetail",
};
</script>
