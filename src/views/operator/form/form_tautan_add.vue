<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../../../api";
import { showToast } from "../../../utils/globalFunctions";

const router = useRouter(); // Inisialisasi router
const btnloading = ref(false);

const tautan = ref({
    id: null,
    judul: "",
    link: "",
});

//method "INSERT"
const add_tautan = async () => {
    btnloading.value = true;
    let formData = new FormData();
    formData.append("judul", tautan.value.judul);
    formData.append("link", tautan.value.link);
    try {
        await api.post(`/api/tautanform`, formData);
        showToast("Data berhasil disimpan", "#4fbe87");
        router.push({ name: "OperatorTautan" });
    } catch (error) {
        console.error("Error updating data:", error);
        showToast("Gagal menyimpan data", "#ff6b6b");
    } finally {
        btnloading.value = false;
    }
};
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
                                        Tambah Tautan
                                    </h4>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <form @submit.prevent="add_tautan()">
                                        <div class="row g-4">
                                            <div class="col-lg-12">
                                                <div class="row mb-3">
                                                    <div class="col-lg-1">
                                                        <label
                                                            for="nameInput"
                                                            class="form-label"
                                                            >Judul</label
                                                        >
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                tautan.judul
                                                            "
                                                            required
                                                        />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-1">
                                                        <label
                                                            for="nameInput"
                                                            class="form-label"
                                                            >Link</label
                                                        >
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                tautan.link
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
