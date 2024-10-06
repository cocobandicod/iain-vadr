<script setup>
import { ref, onMounted, computed, watch } from "vue";
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";
import api from "../../../api";
import { showToast } from "../../../utils/globalFunctions";

const idUser = ref(localStorage.getItem("id_user"));
const isLoading = ref(true);
const sinLoading = ref(true);
const btnloading = ref(false);

const sintaData = ref({
    sinta_score: "",
    y3r: "",
    article: "",
    citation: "",
    hindex: "",
    buku: "",
    hki: "",
});

const profilpengusul = ref({
    id_sinta: "",
});

const detail_profil_peneliti = async () => {
    try {
        const response = await api.get(`/api/formidentitas/${idUser.value}`);
        profilpengusul.value = response.data.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    } finally {
        isLoading.value = false;
    }
};

const fetchDataSinta = async (idSinta) => {
    try {
        const response = await api.get(`/api/sinta/${idSinta}`);
        sintaData.value = response.data;
    } catch (error) {
        console.error("Error fetching Sinta data:", error);
    } finally {
        sinLoading.value = false;
    }
};

watch(profilpengusul, (newVal) => {
    if (newVal.id_sinta) {
        fetchDataSinta(newVal.id_sinta);
    }
});

//method "UPDATE"
const update_sinta = async () => {
    btnloading.value = true;
    //init formData
    let formData = new FormData();
    //assign state value to formData
    formData.append("sinta_score", sintaData.value.sinta_score);
    formData.append("y3r", sintaData.value.y3r);
    formData.append("article", sintaData.value.article);
    formData.append("citation", sintaData.value.citation);
    formData.append("hindex", sintaData.value.hindex);
    formData.append("buku", sintaData.value.buku);
    formData.append("hki", sintaData.value.hki);
    formData.append("_method", "PATCH");
    //store data with API
    try {
        await api.post(`/api/sinta/${idUser.value}`, formData);
        showToast("Data berhasil disimpan", "#4fbe87");
    } catch (error) {
        console.error("Error updating data:", error);
        showToast("Gagal menyimpan data", "#ff6b6b");
    } finally {
        btnloading.value = false;
    }
};

onMounted(() => {
    detail_profil_peneliti();
});
</script>
<template>
    <div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card card-height-100">
                                <div
                                    class="card-header align-items-center d-flex"
                                >
                                    <h4 class="card-title mb-0 flex-grow-1">
                                        Sinta (Indeks Sains dan Teknologi)
                                    </h4>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="row g-4">
                                        <div class="col-lg-2">
                                            <div
                                                v-if="isLoading"
                                                class="d-flex justify-content-center mt-4 mb-4"
                                            >
                                                <div
                                                    class="spinner-border"
                                                    role="status"
                                                >
                                                    <span
                                                        class="visually-hidden"
                                                        >Loading...</span
                                                    >
                                                </div>
                                            </div>
                                            <div v-else class="sticky-side-div">
                                                <div
                                                    class="card ribbon-box border shadow-none right"
                                                >
                                                    <div
                                                        class="ribbon-two ribbon-two-danger"
                                                    ></div>
                                                    <img
                                                        v-if="
                                                            profilpengusul.id_scholar
                                                        "
                                                        :src="`https://scholar.googleusercontent.com/citations?view_op=view_photo&user=${profilpengusul.id_scholar}&citpid=1`"
                                                        alt="Scholar Profile Picture"
                                                        class="img-fluid rounded"
                                                    />
                                                    <div
                                                        class="position-absolute bottom-0 p-3"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-10">
                                            <div
                                                v-if="isLoading"
                                                class="d-flex justify-content-center mt-4 mb-4"
                                            >
                                                <div
                                                    class="spinner-border"
                                                    role="status"
                                                >
                                                    <span
                                                        class="visually-hidden"
                                                        >Loading...</span
                                                    >
                                                </div>
                                            </div>
                                            <div v-else>
                                                <h4>
                                                    {{
                                                        profilpengusul.user
                                                            ?.name
                                                    }}
                                                </h4>
                                                <div
                                                    class="hstack gap-3 flex-wrap"
                                                >
                                                    <div class="text-muted">
                                                        {{
                                                            profilpengusul.program_studi
                                                        }}
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <form
                                                        @submit.prevent="
                                                            update_sinta()
                                                        "
                                                    >
                                                        <div
                                                            class="live-preview"
                                                        >
                                                            <div
                                                                class="row gy-4 mt-2"
                                                            >
                                                                <div
                                                                    class="col-xxl-3 col-md-3 mt-2"
                                                                >
                                                                    <div>
                                                                        <label
                                                                            for="basiInput"
                                                                            class="form-label"
                                                                            >Sinta
                                                                            Score
                                                                            Overall</label
                                                                        >
                                                                        <div
                                                                            v-if="
                                                                                sinLoading
                                                                            "
                                                                            class="form-icon"
                                                                        >
                                                                            <input
                                                                                class="form-control form-control-icon text-muted"
                                                                                value="Loading.."
                                                                            />
                                                                            <i
                                                                                class="mdi mdi-spin mdi-loading fs-16"
                                                                            ></i>
                                                                        </div>
                                                                        <input
                                                                            v-else
                                                                            type="text"
                                                                            class="form-control"
                                                                            v-model="
                                                                                sintaData.sinta_score
                                                                            "
                                                                            readonly
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div
                                                                    class="col-xxl-3 col-md-3 mt-2"
                                                                >
                                                                    <div>
                                                                        <label
                                                                            for="labelInput"
                                                                            class="form-label"
                                                                            >Sinta
                                                                            Skor
                                                                            3Yr</label
                                                                        >
                                                                        <div
                                                                            v-if="
                                                                                sinLoading
                                                                            "
                                                                            class="form-icon"
                                                                        >
                                                                            <input
                                                                                class="form-control form-control-icon text-muted"
                                                                                value="Loading.."
                                                                            />
                                                                            <i
                                                                                class="mdi mdi-spin mdi-loading fs-16"
                                                                            ></i>
                                                                        </div>
                                                                        <input
                                                                            v-else
                                                                            type="text"
                                                                            class="form-control"
                                                                            v-model="
                                                                                sintaData.y3r
                                                                            "
                                                                            readonly
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xxl-3 col-md-3 mt-2"
                                                                >
                                                                    <div>
                                                                        <label
                                                                            for="labelInput"
                                                                            class="form-label"
                                                                            >Scopus
                                                                            Citations</label
                                                                        >
                                                                        <div
                                                                            v-if="
                                                                                sinLoading
                                                                            "
                                                                            class="form-icon"
                                                                        >
                                                                            <input
                                                                                class="form-control form-control-icon text-muted"
                                                                                value="Loading.."
                                                                            />
                                                                            <i
                                                                                class="mdi mdi-spin mdi-loading fs-16"
                                                                            ></i>
                                                                        </div>
                                                                        <input
                                                                            v-else
                                                                            type="text"
                                                                            class="form-control"
                                                                            v-model="
                                                                                sintaData.citation
                                                                            "
                                                                            readonly
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xxl-3 col-md-3 mt-2"
                                                                >
                                                                    <div>
                                                                        <label
                                                                            for="labelInput"
                                                                            class="form-label"
                                                                            >Scopus
                                                                            Article</label
                                                                        >
                                                                        <div
                                                                            v-if="
                                                                                sinLoading
                                                                            "
                                                                            class="form-icon"
                                                                        >
                                                                            <input
                                                                                class="form-control form-control-icon text-muted"
                                                                                value="Loading.."
                                                                            />
                                                                            <i
                                                                                class="mdi mdi-spin mdi-loading fs-16"
                                                                            ></i>
                                                                        </div>
                                                                        <input
                                                                            v-else
                                                                            type="text"
                                                                            class="form-control"
                                                                            v-model="
                                                                                sintaData.article
                                                                            "
                                                                            readonly
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xxl-3 col-md-3 mt-2"
                                                                >
                                                                    <div>
                                                                        <label
                                                                            for="labelInput"
                                                                            class="form-label"
                                                                            >Scopus
                                                                            H-Index</label
                                                                        >
                                                                        <div
                                                                            v-if="
                                                                                sinLoading
                                                                            "
                                                                            class="form-icon"
                                                                        >
                                                                            <input
                                                                                class="form-control form-control-icon text-muted"
                                                                                value="Loading.."
                                                                            />
                                                                            <i
                                                                                class="mdi mdi-spin mdi-loading fs-16"
                                                                            ></i>
                                                                        </div>
                                                                        <input
                                                                            v-else
                                                                            type="text"
                                                                            class="form-control"
                                                                            v-model="
                                                                                sintaData.hindex
                                                                            "
                                                                            readonly
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xxl-3 col-md-3 mt-2"
                                                                >
                                                                    <div>
                                                                        <label
                                                                            for="labelInput"
                                                                            class="form-label"
                                                                            >Buku
                                                                        </label>
                                                                        <div
                                                                            v-if="
                                                                                sinLoading
                                                                            "
                                                                            class="form-icon"
                                                                        >
                                                                            <input
                                                                                class="form-control form-control-icon text-muted"
                                                                                value="Loading.."
                                                                            />
                                                                            <i
                                                                                class="mdi mdi-spin mdi-loading fs-16"
                                                                            ></i>
                                                                        </div>
                                                                        <input
                                                                            v-else
                                                                            type="text"
                                                                            class="form-control"
                                                                            v-model="
                                                                                sintaData.buku
                                                                            "
                                                                            readonly
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xxl-3 col-md-3 mt-2"
                                                                >
                                                                    <div>
                                                                        <label
                                                                            for="labelInput"
                                                                            class="form-label"
                                                                            >HKI</label
                                                                        >
                                                                        <div
                                                                            v-if="
                                                                                sinLoading
                                                                            "
                                                                            class="form-icon"
                                                                        >
                                                                            <input
                                                                                class="form-control form-control-icon text-muted"
                                                                                value="Loading.."
                                                                            />
                                                                            <i
                                                                                class="mdi mdi-spin mdi-loading fs-16"
                                                                            ></i>
                                                                        </div>
                                                                        <input
                                                                            v-else
                                                                            type="text"
                                                                            class="form-control"
                                                                            v-model="
                                                                                sintaData.hki
                                                                            "
                                                                            readonly
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                        </div>
                                                        <div
                                                            class="float-end mt-4"
                                                        >
                                                            <button
                                                                type="submit"
                                                                class="btn btn-success"
                                                            >
                                                                <span
                                                                    v-if="
                                                                        btnloading
                                                                    "
                                                                >
                                                                    <i
                                                                        class="mdi mdi-spin mdi-loading"
                                                                    ></i>
                                                                    Loading...
                                                                </span>
                                                                <span v-else>
                                                                    <i
                                                                        class="ri-refresh-line align-bottom me-1"
                                                                    ></i>
                                                                    Sinkronisasi
                                                                    Sinta
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!--end row-->
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>
</template>
<style lang=""></style>
