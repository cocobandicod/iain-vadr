<script setup>
import { ref, computed, onMounted } from "vue";
import api from "../api";
import { formatTanggalsaja } from "../utils/globalFunctions";
import GlobalFooter from "../components/footer.vue";

const pengumuman = ref([]);
const isLoading = ref(true);
const searchQuery = ref("");
const currentPage = ref(1);
const totalPages = ref(1);

// Tampil Pengumuman
const fetchDataPengumuman = async (page = 1) => {
    isLoading.value = true;
    try {
        const response = await api.get(`/api/pengumuman?page=${page}`);
        pengumuman.value = response.data.data.data;
        totalPages.value = response.data.data.last_page;
        currentPage.value = response.data.data.current_page;
    } catch (error) {
        console.error("Error fetching pengumuman data:", error);
    } finally {
        isLoading.value = false;
    }
};

// Pencarian Pengumuman
const filteredPengumuman = computed(() => {
    if (!searchQuery.value) {
        return pengumuman.value;
    }
    return pengumuman.value.filter((item) =>
        item.judul_pengumuman
            .toLowerCase()
            .includes(searchQuery.value.toLowerCase())
    );
});

const isFileAvailable = (url) => {
    // Memastikan URL tidak hanya mengarah ke direktori
    return url && !url.endsWith("/storage/pengumuman");
};

onMounted(() => {
    fetchDataPengumuman();
});

const goToNextPage = () => {
    if (currentPage.value < totalPages.value) {
        fetchDataPengumuman(currentPage.value + 1);
    }
};

const goToPrevPage = () => {
    if (currentPage.value > 1) {
        fetchDataPengumuman(currentPage.value - 1);
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
                        <h3 class="mb-3 fw-semibold">Pengumuman</h3>
                        <p class="text-muted mb-4">
                            Pengumuman Terbaru terkait dengan aturan maupun
                            informasi Penelitian dan Pengabdian kepada
                            Masyarakat.
                        </p>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-lg-10 gy-8">
                    <div class="form-icon mb-4">
                        <input
                            type="text"
                            class="form-control form-control-icon"
                            id="iconInput"
                            placeholder="Cari Pengumuman"
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
                        v-else-if="filteredPengumuman.length === 0"
                        class="alert alert-danger text-center"
                        role="alert"
                    >
                        Belum ada berita
                    </div>
                    <div
                        v-else
                        class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box mt-2"
                        v-for="(pengumuman, index) in filteredPengumuman"
                        :key="index"
                    >
                        <div class="accordion-item">
                            <h2
                                class="accordion-header"
                                :id="'genques-heading' + index"
                            >
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    :data-bs-target="
                                        '#genques-collapse' + index
                                    "
                                    aria-expanded="false"
                                    :aria-controls="'genques-collapse' + index"
                                >
                                    <div class="row">
                                        <div class="col-lg-12 fs-14">
                                            {{ pengumuman.judul_pengumuman }}
                                        </div>
                                        <div class="col-lg-12 pt-2 text-muted">
                                            <i
                                                class="ri-calendar-todo-fill me-1"
                                            ></i>
                                            {{
                                                formatTanggalsaja(
                                                    pengumuman.tgl_pengumuman
                                                )
                                            }}
                                            <i
                                                class="ri-account-circle-line ms-2 me-1"
                                            ></i>
                                            {{ pengumuman.user.name }}
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div
                                :id="'genques-collapse' + index"
                                class="accordion-collapse collapse"
                                :aria-labelledby="'genques-heading' + index"
                                data-bs-parent="#genques-accordion"
                            >
                                <div
                                    class="accordion-body ff-secondary text-black"
                                >
                                    {{ pengumuman.isi_pengumuman }}
                                    <div class="col-lg-12 pt-2 text-muted">
                                        <div
                                            v-if="
                                                isFileAvailable(
                                                    pengumuman.file_pengumuman
                                                )
                                            "
                                        >
                                            <a
                                                :href="
                                                    pengumuman.file_pengumuman
                                                "
                                                class="btn btn-danger btn-label rounded-pill"
                                                target="_blank"
                                                download
                                            >
                                                <i
                                                    class="ri-file-download-line label-icon align-middle rounded-pill me-2"
                                                ></i>
                                                Unduh Dokumen
                                            </a>
                                        </div>
                                        <div v-else>
                                            <p>Dokumen tidak tersedia.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
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
            <!--end row-->
        </div>
        <!-- end container -->
    </section>
    <!-- Start footer -->
    <GlobalFooter />
    <!-- end footer -->
</template>
