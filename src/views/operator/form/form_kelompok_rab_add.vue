<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../../../api";
import { showToast } from "../../../utils/globalFunctions";

const router = useRouter(); // Inisialisasi router
const btnloading = ref(false);

const rab = ref({
    id: null,
    kelompok_rab: "",
});

//method "INSERT"
const add_rab = async () => {
    btnloading.value = true;
    let formData = new FormData();
    formData.append("kelompok_rab", rab.value.kelompok_rab);
    try {
        await api.post(`/api/kelompokrabform`, formData);
        showToast("Data berhasil disimpan", "#4fbe87");
        router.push({ name: "OperatorRab" });
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
                                        Tambah Kelompok RAB
                                    </h4>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <form @submit.prevent="add_rab()">
                                        <div class="row g-4">
                                            <div class="col-lg-12">
                                                <div class="row mb-3">
                                                    <div class="col-lg-2">
                                                        <label
                                                            for="nameInput"
                                                            class="form-label"
                                                            >Kelompok RAB</label
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
