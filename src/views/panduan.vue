<script setup>
import { ref, onMounted } from "vue";
import api from "../api";
import { getEmbedUrl } from "../utils/globalFunctions";
import GlobalFooter from "../components/footer.vue";

const panduan = ref([]);
const isLoading = ref(true);

const fetchDataPanduan = async () => {
    isLoading.value = true;
    try {
        const response = await api.get("/api/panduan");
        panduan.value = response.data.data.data;
    } catch (error) {
        console.error("Error fetching panduan data:", error);
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchDataPanduan();
});
</script>

<template>
    <section class="section bg-light">
        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h3 class="mb-3 fw-semibold">Tutorial Pengusulan</h3>
                        <p class="text-muted mb-4">
                            Panduan Teknis Usulan Penelitian dan Pengabdian
                            kepada Masyarakat
                        </p>
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
                        v-else-if="panduan.length === 0"
                        class="alert alert-danger text-center"
                        role="alert"
                    >
                        Belum ada panduan
                    </div>
                    <div
                        class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box mt-2"
                        id="genques-accordion"
                        v-for="(item, index) in panduan"
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
                                            {{ item.judul_panduan }}
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
                                    <div
                                        class="ratio"
                                        style="--vz-aspect-ratio: 50%"
                                    >
                                        <iframe
                                            :src="getEmbedUrl(item.youtube)"
                                            title="YouTube video"
                                            allowfullscreen
                                        ></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
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
    name: "panduan",
};
</script>
