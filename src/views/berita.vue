<script setup>
import { ref, computed, onMounted } from "vue";
import api from "../api";
import { formatTanggalsaja, truncateText } from "../utils/globalFunctions";
import GlobalFooter from "../components/footer.vue";

const berita = ref([]);
const isLoading = ref(true);
const searchQuery = ref("");
const currentPage = ref(1);
const totalPages = ref(1);

// Tampil Berita
const fetchDetailBerita = async (page = 1) => {
    isLoading.value = true;
    try {
        const response = await api.get(`/api/berita?page=${page}`);
        berita.value = response.data.data.data;
        totalPages.value = response.data.data.last_page;
        currentPage.value = response.data.data.current_page;
    } catch (error) {
        console.error("Error fetching berita data:", error);
    } finally {
        isLoading.value = false;
    }
};

// Pencarian Berita
const filteredBerita = computed(() => {
    if (!searchQuery.value) {
        return berita.value;
    }
    return berita.value.filter((item) =>
        item.judul_berita
            .toLowerCase()
            .includes(searchQuery.value.toLowerCase())
    );
});

onMounted(() => {
    fetchDetailBerita();
});

const goToNextPage = () => {
    if (currentPage.value < totalPages.value) {
        fetchDetailBerita(currentPage.value + 1);
    }
};

const goToPrevPage = () => {
    if (currentPage.value > 1) {
        fetchDetailBerita(currentPage.value - 1);
    }
};
</script>

<template>
    <section class="section bg-light">
        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h3 class="mb-3 fw-semibold">Berita</h3>
                        <p class="text-muted mb-4">
                            Berita terbaru terkait dengan aturan maupun
                            informasi Penelitian dan Pengabdian kepada
                            Masyarakat.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10 gy-8">
                    <div class="form-icon mb-4">
                        <input
                            type="text"
                            class="form-control form-control-icon"
                            id="iconInput"
                            placeholder="Cari Berita"
                            v-model="searchQuery"
                        />
                        <i class="ri-search-line text-muted"></i>
                    </div>
                    <div v-if="isLoading" class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div
                        v-else-if="filteredBerita.length === 0"
                        class="alert alert-danger text-center"
                        role="alert"
                    >
                        Belum ada berita
                    </div>
                    <div
                        v-else
                        class="col-lg-12 card pt-0 pb-0 mb-2 mt-2"
                        v-for="(item, index) in filteredBerita"
                        :key="index"
                    >
                        <div class="row p-3">
                            <div class="col-lg-4 pb-3">
                                <img
                                    :src="item.image"
                                    class="img-fluid rounded"
                                    alt="Responsive image"
                                />
                            </div>
                            <div class="col-lg-8">
                                <router-link
                                    :to="{
                                        name: 'BeritaDetail',
                                        params: {
                                            slug: item.judul_seo,
                                        },
                                    }"
                                    class="text-decoration-none"
                                >
                                    <h5 class="fs-18">
                                        {{ item.judul_berita }}
                                    </h5>
                                </router-link>
                                <p class="text-muted fs-13 mb-0 mt-2">
                                    <i class="ri-calendar-todo-fill me-1"></i>
                                    {{ formatTanggalsaja(item.tgl_berita) }}
                                    {{ item.jam_berita }}
                                    <i
                                        class="ri-account-circle-line ms-2 me-1"
                                    ></i>
                                    {{ item.user.name }}
                                </p>
                                <p class="text-muted my-3 ff-secondary">
                                    {{ truncateText(item.isi_berita, 200) }}
                                </p>

                                <div>
                                    <router-link
                                        :to="{
                                            name: 'BeritaDetail',
                                            params: {
                                                slug: item.judul_seo,
                                            },
                                        }"
                                        class="text-decoration-none"
                                    >
                                        <span class="fs-13 fw-medium">
                                            Selengkapnya
                                            <i
                                                class="ri-arrow-right-s-line align-bottom"
                                            ></i>
                                        </span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button
                            @click="goToPrevPage"
                            :disabled="currentPage === 1"
                            type="button"
                            class="btn btn-success btn-label left me-1"
                        >
                            <i
                                class="ri-arrow-left-line label-icon align-middle fs-16"
                            ></i
                            >Prev
                        </button>
                        <button
                            @click="goToNextPage"
                            :disabled="currentPage === totalPages"
                            type="button"
                            class="btn btn-success btn-label right ms-1"
                        >
                            <i
                                class="ri-arrow-right-line label-icon align-middle fs-16"
                            ></i
                            >Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <GlobalFooter />
</template>

<script>
export default {
    name: "berita",
};
</script>
