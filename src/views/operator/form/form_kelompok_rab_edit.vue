<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "../../../api";
import { showToast } from "../../../utils/globalFunctions";

const route = useRoute();
const router = useRouter(); // Inisialisasi router
const isLoading = ref(true);
const btnloading = ref(false);

const rab = ref({
    id: null,
    kelompok_rab: "",
});

const detail_rab = async () => {
    try {
        const response = await api.get(
            `/api/kelompokrabform/${route.params.id}`
        );
        rab.value = response.data.data;
    } catch (error) {
        if (error.response && error.response.status === 404) {
            router.push({ name: "NotFound" });
        } else {
            console.error("Error fetching data:", error);
        }
    } finally {
        isLoading.value = false;
    }
};

//method "UPDATE"
const update_rab = async () => {
    btnloading.value = true;
    let formData = new FormData();
    formData.append("kelompok_rab", rab.value.kelompok_rab);

    formData.append("_method", "PATCH");

    try {
        await api.post(`/api/kelompokrabform/${route.params.id}`, formData);
        showToast("Data berhasil disimpan", "#4fbe87");
        router.push({ name: "OperatorRab" });
    } catch (error) {
        console.error("Error updating data:", error);
        showToast("Gagal menyimpan data", "#ff6b6b");
    } finally {
        btnloading.value = false;
    }
};

onMounted(() => {
    detail_rab();
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
                                        Ubah Kelompok RAB
                                    </h4>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div
                                        v-if="isLoading"
                                        class="d-flex justify-content-center mt-4 mb-4"
                                    >
                                        <div
                                            class="spinner-border"
                                            role="status"
                                        >
                                            <span class="visually-hidden"
                                                >Loading...</span
                                            >
                                        </div>
                                    </div>
                                    <div v-else>
                                        <form @submit.prevent="update_rab()">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="row mb-3">
                                                        <div class="col-lg-2">
                                                            <label
                                                                for="nameInput"
                                                                class="form-label"
                                                                >Kelompok
                                                                RAB</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                v-model="
                                                                    rab.kelompok_rab
                                                                "
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-start">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-success"
                                                    >
                                                        <span v-if="btnloading">
                                                            <i
                                                                class="mdi mdi-spin mdi-loading"
                                                            ></i>
                                                            Loading...
                                                        </span>
                                                        <span v-else>
                                                            <i
                                                                class="ri-save-line align-bottom me-1"
                                                            ></i>
                                                            Simpan
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
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
