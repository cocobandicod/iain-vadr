<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "../../../api";
import { showToast, showAlert } from "../../../utils/globalFunctions";
import Editor from "@tinymce/tinymce-vue";

const route = useRoute();
const router = useRouter(); // Inisialisasi router
const isLoading = ref(true);
const btnloading = ref(false);

const sponsor = ref({
    id: null,
    judul: "",
    image: null,
});

const detail_sponsor = async () => {
    try {
        const response = await api.get(`/api/sponsorform/${route.params.id}`);
        sponsor.value = response.data.data;
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

const allowedFormats = ["image/jpeg", "image/png"]; // Allowed formats
const maxSize = 1 * 1024 * 1024; // 2MB in bytes

const selectedFileName = ref(null); // Nama file yang dipilih
const handleFileChange = (e) => {
    const file = e.target.files[0];

    if (!file) {
        selectedFileName.value = null; // Clear file name if no file is selected
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
    selectedFileName.value = file.name;
    sponsor.value.image = file;
};

//method "UPDATE"
const update_sponsor = async () => {
    btnloading.value = true;
    let formData = new FormData();
    formData.append("judul", sponsor.value.judul);
    if (sponsor.value.image && sponsor.value.image instanceof File) {
        formData.append("image", sponsor.value.image);
    }
    formData.append("_method", "PATCH");
    try {
        await api.post(`/api/sponsorform/${route.params.id}`, formData);
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

const isFileAvailable = (url) => {
    return (
        typeof url === "string" && url.endsWith("/storage/sponsor") === false
    );
};

onMounted(() => {
    detail_sponsor();
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
                                        Ubah Sponsor
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
                                        <form
                                            @submit.prevent="update_sponsor()"
                                        >
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
                                                            <div
                                                                v-if="
                                                                    isFileAvailable(
                                                                        sponsor.image
                                                                    ) &&
                                                                    !selectedFileName
                                                                "
                                                            >
                                                                <img
                                                                    class="img-thumbnail mb-2"
                                                                    width="600"
                                                                    :src="
                                                                        sponsor.image
                                                                    "
                                                                />
                                                            </div>
                                                            <!-- Display the selected file name if a new file is chosen -->
                                                            <div
                                                                v-if="
                                                                    selectedFileName
                                                                "
                                                                class="text-success-emphasis pt-0 pb-2"
                                                            >
                                                                File yang
                                                                dipilih:
                                                                {{
                                                                    selectedFileName
                                                                }}
                                                            </div>
                                                            <div
                                                                v-else
                                                                class="text-danger-emphasis pt-2 pb-2"
                                                            >
                                                                Silahkan upload
                                                                kembali untuk
                                                                merubah File
                                                            </div>
                                                            <!-- Input file -->
                                                            <input
                                                                type="file"
                                                                class="form-control"
                                                                @change="
                                                                    handleFileChange
                                                                "
                                                            />
                                                            <div
                                                                class="form-text"
                                                            >
                                                                * Format JPG,
                                                                PNG, dengan
                                                                ukuran kurang 1
                                                                Mb
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
