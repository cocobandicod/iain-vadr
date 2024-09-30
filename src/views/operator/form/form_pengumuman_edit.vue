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

const pengumuman = ref({
    id: null,
    judul_pengumuman: "",
    tgl_pengumuman: "",
    isi_pengumuman: "",
    file_pengumuman: null,
});

// TinyMCE
const content = ref(pengumuman.value.isi_pengumuman); // Initialize with data
const editorInit = {
    height: 500,
    menubar: "edit view format",
    plugins: "image media code table link lists",
    toolbar:
        "undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | table | link | code",
    table_toolbar:
        "tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
    content_style:
        "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
};

const detail_pengumuman = async () => {
    try {
        const response = await api.get(
            `/api/pengumumanform/${route.params.id}`
        );
        pengumuman.value = response.data.data;
        content.value = pengumuman.value.isi_pengumuman; // Update content with fetched data
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

const allowedFormats = [
    "image/jpeg", // JPG
    "image/png", // PNG
    "application/pdf", // PDF
    "application/msword", // DOC
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document", // DOCX
];
const maxSize = 5 * 1024 * 1024; // 5MB in bytes

const selectedFileName = ref(null); // Nama file yang dipilih
const handleFileChange = (e) => {
    const file = e.target.files[0];

    if (!file) {
        selectedFileName.value = null; // Clear file name if no file is selected
        pengumuman.value.file_pengumuman = null; // Clear file if no file is selected
        return;
    }

    // Check file size
    if (file.size > maxSize) {
        showAlert("Perhatian!", "Ukuran file harus kurang dari 5MB", "info");
        e.target.value = null; // Clear file input
        return;
    }

    // Check file format
    if (!allowedFormats.includes(file.type)) {
        showAlert("Perhatian!", "Format file harus JPG, PNG, PDF, DOC", "info");
        e.target.value = null; // Clear file input
        return;
    }

    // Assign valid file and set the file name for display
    selectedFileName.value = file.name;
    pengumuman.value.file_pengumuman = file; // Hanya assign file, jangan ubah URL lama
};

//method "UPDATE"
const update_pengumuman = async () => {
    btnloading.value = true;
    let formData = new FormData();
    formData.append("judul_pengumuman", pengumuman.value.judul_pengumuman);
    formData.append("tgl_pengumuman", pengumuman.value.tgl_pengumuman);
    formData.append("isi_pengumuman", content.value);
    if (
        pengumuman.value.file_pengumuman &&
        pengumuman.value.file_pengumuman instanceof File
    ) {
        formData.append("file_pengumuman", pengumuman.value.file_pengumuman);
    }

    formData.append("_method", "PATCH");

    try {
        await api.post(`/api/pengumumanform/${route.params.id}`, formData);
        showToast("Data berhasil disimpan", "#4fbe87");
        router.push({ name: "OperatorPengumuman" });
    } catch (error) {
        console.error("Error updating data:", error);
        showToast("Gagal menyimpan data", "#ff6b6b");
        document.querySelector('input[type="file"]').value = "";
    } finally {
        btnloading.value = false;
    }
};

// Check if the file URL is valid (file is available)
const isFileAvailable = (url) => {
    return (
        typeof url === "string" && url.endsWith("/storage/pengumuman") === false
    );
};

onMounted(() => {
    detail_pengumuman();
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
                                        Ubah Pengumuman
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
                                            @submit.prevent="
                                                update_pengumuman()
                                            "
                                        >
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="row mb-3">
                                                        <div class="col-lg-2">
                                                            <label
                                                                for="nameInput"
                                                                class="form-label"
                                                                >Judul
                                                                Pengumuman</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                v-model="
                                                                    pengumuman.judul_pengumuman
                                                                "
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-2">
                                                            <label
                                                                for="websiteUrl"
                                                                class="form-label"
                                                                >Tanggal
                                                                Pengumuman</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input
                                                                type="date"
                                                                class="form-control"
                                                                v-model="
                                                                    pengumuman.tgl_pengumuman
                                                                "
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-2">
                                                            <label
                                                                class="form-label"
                                                                >Isi
                                                                Pengumuman</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <Editor
                                                                v-model="
                                                                    content
                                                                "
                                                                api-key="qw6kskzpvqfx4s36csfnlp9jzmhswei0su32l30dl9jvd4sa"
                                                                :init="
                                                                    editorInit
                                                                "
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-2">
                                                            <label
                                                                class="form-label"
                                                                >Upload
                                                                File</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div
                                                                v-if="
                                                                    isFileAvailable(
                                                                        pengumuman.file_pengumuman
                                                                    ) &&
                                                                    !selectedFileName
                                                                "
                                                            >
                                                                <a
                                                                    :href="
                                                                        pengumuman.file_pengumuman
                                                                    "
                                                                    class="btn btn-danger btn-label btn-sm rounded-pill"
                                                                    target="_blank"
                                                                    download
                                                                >
                                                                    <i
                                                                        class="ri-file-download-line label-icon align-middle rounded-pill me-2"
                                                                    ></i>
                                                                    Lihat
                                                                    Dokumen
                                                                </a>
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
                                                                PNG, PDF, DOC,
                                                                DOCX dengan
                                                                ukuran kurang 5
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
