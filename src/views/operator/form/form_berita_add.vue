<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../../../api";
import { showToast, showAlert } from "../../../utils/globalFunctions";
import Editor from "@tinymce/tinymce-vue";

const router = useRouter(); // Inisialisasi router
const btnloading = ref(false);
const idUser = ref(localStorage.getItem("id_user"));

const berita = ref({
    id: null,
    judul_berita: "",
    tgl_berita: "",
    isi_berita: "",
    image: null,
});

// TinyMCE
const content = ref(); // Initialize with berita data
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

const allowedFormats = ["image/jpeg", "image/png"]; // Allowed formats
const maxSize = 2 * 1024 * 1024; // 2MB in bytes

const handleFileChange = (e) => {
    const file = e.target.files[0];

    if (!file) {
        berita.value.image = null; // Clear file if no file is selected
        return;
    }

    // Check file size
    if (file.size > maxSize) {
        showAlert("Perhatian!", "Ukuran file harus kurang dari 2MB", "info");
        e.target.value = null; // Clear file input
        return;
    }

    // Check file format
    if (!allowedFormats.includes(file.type)) {
        showAlert("Perhatian!", "Format file harus JPG atau PNG", "info");
        e.target.value = null; // Clear file input
        return;
    }

    // Assign valid file to berita.image
    berita.value.image = file;
};

//method "INSERT"
const add_berita = async () => {
    btnloading.value = true;
    let formData = new FormData();
    formData.append("id_user", idUser.value);
    formData.append("judul_berita", berita.value.judul_berita);
    formData.append("tgl_berita", berita.value.tgl_berita);
    //formData.append("isi_berita", berita.value.isi_berita);
    formData.append("isi_berita", content.value);
    formData.append("image", berita.value.image);
    try {
        await api.post(`/api/beritaform`, formData);
        showToast("Data berhasil disimpan", "#4fbe87");
        router.push({ name: "OperatorBerita" });
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
                                        Tambah Berita
                                    </h4>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <form @submit.prevent="add_berita()">
                                        <div class="row g-4">
                                            <div class="col-lg-12">
                                                <div class="row mb-3">
                                                    <div class="col-lg-2">
                                                        <label
                                                            for="nameInput"
                                                            class="form-label"
                                                            >Judul Berita</label
                                                        >
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="
                                                                berita.judul_berita
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
                                                            Berita</label
                                                        >
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input
                                                            type="date"
                                                            class="form-control"
                                                            v-model="
                                                                berita.tgl_berita
                                                            "
                                                            required
                                                        />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-2">
                                                        <label
                                                            class="form-label"
                                                            >Isi Berita</label
                                                        >
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <Editor
                                                            v-model="content"
                                                            api-key="qw6kskzpvqfx4s36csfnlp9jzmhswei0su32l30dl9jvd4sa"
                                                            :init="editorInit"
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
                                                            2 Mb
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
