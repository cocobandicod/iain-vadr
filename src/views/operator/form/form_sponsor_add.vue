<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../../../api";
import { showToast, showAlert } from "../../../utils/globalFunctions";

const router = useRouter(); // Inisialisasi router
const btnloading = ref(false);

const sponsor = ref({
    id: null,
    judul: "",
    image: null,
});

const allowedFormats = ["image/jpeg", "image/png"]; // Allowed formats
const maxSize = 1 * 1024 * 1024; // 2MB in bytes

const handleFileChange = (e) => {
    const file = e.target.files[0];

    if (!file) {
        sponsor.value.image = null; // Clear file if no file is selected
        return;
    }

    // Check file size
    if (file.size > maxSize) {
        showAlert("Perhatian!", "Ukuran file harus kurang dari 1MB", "info");
        e.target.value = null; // Clear file input
        return;
    }

    // Check file format
    if (!allowedFormats.includes(file.type)) {
        showAlert("Perhatian!", "Format file harus JPG atau PNG", "info");
        e.target.value = null; // Clear file input
        return;
    }

    // Assign valid file to sponsor.image
    sponsor.value.image = file;
};

//method "INSERT"
const add_sponsor = async () => {
    btnloading.value = true;
    let formData = new FormData();
    formData.append("judul", sponsor.value.judul);
    formData.append("image", sponsor.value.image);
    try {
        await api.post(`/api/sponsorform`, formData);
        showToast("Data berhasil disimpan", "#4fbe87");
        router.push({ name: "OperatorSponsor" });
    } catch (error) {
        console.error("Error updating data:", error);
        showToast("Gagal menyimpan data", "#ff6b6b");
        document.querySelector('input[type="file"]').value = "";
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
                                        Tambah Sponsor
                                    </h4>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <form @submit.prevent="add_sponsor()">
                                        <div class="row g-4">
                                            <div class="col-lg-12">
                                                <div class="row mb-3">
                                                    <div class="col-lg-2">
                                                        <label
                                                            for="nameInput"
                                                            class="form-label"
                                                            >Judul</label
                                                        >
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                sponsor.judul
                                                            "
                                                            required
                                                        />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-2">
                                                        <label
                                                            class="form-label"
                                                            >Gambar</label
                                                        >
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input
                                                            type="file"
                                                            class="form-control"
                                                            @change="
                                                                handleFileChange(
                                                                    $event
                                                                )
                                                            "
                                                            required
                                                        />
                                                        <div class="form-text">
                                                            * Format JPG, PNG,
                                                            dengan ukuran kurang
                                                            1 Mb
                                                        </div>
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
