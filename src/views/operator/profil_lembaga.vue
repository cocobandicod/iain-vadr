<script setup>
import { ref, onMounted } from "vue";
import api from "../../api";
import { showToast } from "../../utils/globalFunctions";

const id = ref(1);
const isLoading = ref(true);
const btnloading = ref(false);

const profillembaga = ref({
    id: null,
    no_sk: "",
    nama_lembaga: "",
    alamat_lembaga: "",
    no_telepon: "",
    no_fax: "",
    email: "",
    website: "",
    nama_jabatan: "",
    nidn_pimpinan: "",
    nama_pimpinan: "",
});

const detail_profil_peneliti = async () => {
    try {
        const response = await api.get(`/api/formlembaga/1`);
        profillembaga.value = response.data.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    } finally {
        isLoading.value = false;
    }
};

//method "UPDATE"
const update_profil = async () => {
    btnloading.value = true;
    //init formData
    let formData = new FormData();
    //assign state value to formData
    formData.append("no_sk", profillembaga.value.no_sk);
    formData.append("nama_lembaga", profillembaga.value.nama_lembaga);
    formData.append("alamat_lembaga", profillembaga.value.alamat_lembaga);
    formData.append("no_telepon", profillembaga.value.no_telepon);
    formData.append("no_fax", profillembaga.value.no_fax);
    formData.append("email", profillembaga.value.email);
    formData.append("website", profillembaga.value.website);
    formData.append("nama_jabatan", profillembaga.value.nama_jabatan);
    formData.append("nidn_pimpinan", profillembaga.value.nidn_pimpinan);
    formData.append("nama_pimpinan", profillembaga.value.nama_pimpinan);
    formData.append("_method", "PATCH");
    //store data with API
    try {
        await api.post(`/api/formlembaga/${id.value}`, formData);
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
                                        Profil Lembaga Penelitian & Pengabdian
                                        Kepada Masyarakat
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
                                        <form @submit.prevent="update_profil()">
                                            <div class="row g-4">
                                                <div class="col-lg-6">
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label
                                                                for="nameInput"
                                                                class="form-label"
                                                                >No SK Pendirian
                                                                Lembaga</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                v-model="
                                                                    profillembaga.no_sk
                                                                "
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label
                                                                for="websiteUrl"
                                                                class="form-label"
                                                                >Nama
                                                                Lembaga</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                v-model="
                                                                    profillembaga.nama_lembaga
                                                                "
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label
                                                                class="form-label"
                                                                >Alamat
                                                                Lembaga</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                v-model="
                                                                    profillembaga.alamat_lembaga
                                                                "
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label
                                                                class="form-label"
                                                                >No
                                                                Telepon</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                v-model="
                                                                    profillembaga.no_telepon
                                                                "
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label
                                                                class="form-label"
                                                                >No Fax</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                v-model="
                                                                    profillembaga.no_fax
                                                                "
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label
                                                                for="contactNumber"
                                                                class="form-label"
                                                                >Email</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input
                                                                type="email"
                                                                class="form-control"
                                                                v-model="
                                                                    profillembaga.email
                                                                "
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label
                                                                class="form-label"
                                                                >Website</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input
                                                                type="url"
                                                                class="form-control"
                                                                v-model="
                                                                    profillembaga.website
                                                                "
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label
                                                                for="nameInput"
                                                                class="form-label"
                                                                >Nama
                                                                Jabatan</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                v-model="
                                                                    profillembaga.nama_jabatan
                                                                "
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label
                                                                for="nameInput"
                                                                class="form-label"
                                                                >NIDN
                                                                Pimpinan</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                v-model="
                                                                    profillembaga.nidn_pimpinan
                                                                "
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label
                                                                for="nameInput"
                                                                class="form-label"
                                                                >Nama</label
                                                            >
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                v-model="
                                                                    profillembaga.nama_pimpinan
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
