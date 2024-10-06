<script setup>
import { ref, onMounted, computed } from "vue";
import api from "../../../api";

const idUser = ref(localStorage.getItem("id_user"));
const isLoading3 = ref(true);
const isLoading4 = ref(false);

const profilpengusul = ref({
    id_sinta: "",
    id_scholar: "",
    nidn: "",
    klaster: "",
    institusi: "",
    program_studi: "",
    jenjang_pendidikan: "",
    jabatan_akademik: "",
    alamat: "",
    tempat_lahir: "",
    tanggal_lahir: "",
    no_ktp: "",
    no_telepon: "",
    no_hp: "",
    alamat_surel: "",
    website_personal: "",
});

const detail_profil_peneliti = async () => {
    try {
        const response = await api.get(`/api/profilpengusul/${idUser.value}`);
        profilpengusul.value = response.data.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    } finally {
        isLoading3.value = false;
    }
};

//method "UPDATE"
const update_profil = async () => {
    isLoading4.value = true;
    //init formData
    let formData = new FormData();
    //assign state value to formData
    formData.append("id_sinta", profilpengusul.value.id_sinta);
    formData.append("id_scholar", profilpengusul.value.id_scholar);
    formData.append(
        "jenjang_pendidikan",
        profilpengusul.value.jenjang_pendidikan
    );
    formData.append("jabatan_akademik", profilpengusul.value.jabatan_akademik);
    formData.append("alamat", profilpengusul.value.alamat);
    formData.append("tempat_lahir", profilpengusul.value.tempat_lahir);
    formData.append("tanggal_lahir", profilpengusul.value.tanggal_lahir);
    formData.append("no_ktp", profilpengusul.value.no_ktp);
    formData.append("no_telepon", profilpengusul.value.no_telepon);
    formData.append("no_hp", profilpengusul.value.no_hp);
    formData.append("alamat_surel", profilpengusul.value.alamat_surel);
    formData.append("website_personal", profilpengusul.value.website_personal);
    formData.append("_method", "PATCH");
    //store data with API
    try {
        await api.post(`/api/profilpengusul/${idUser.value}`, formData);
        alert("Data berhasil disimpan");
    } catch (error) {
        console.error("Error updating data:", error);
        alert("Gagal menyimpan data");
    } finally {
        isLoading4.value = false;
    }
};

onMounted(() => {
    detail_profil_peneliti();
});
</script>
<template>
    <div
        class="modal fade"
        id="form_modal_peneliti"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Identitas</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <form @submit.prevent="update_profil()">
                    <div class="modal-body">
                        <div
                            v-if="isLoading3"
                            class="d-flex justify-content-center mt-4 mb-4"
                        >
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div v-else class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4 mt-2">
                                    <div class="col-xxl-3 col-md-3 mt-2">
                                        <div>
                                            <label
                                                for="basiInput"
                                                class="form-label"
                                                >NIDN/NIDK</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="profilpengusul.nidn"
                                                disabled
                                            />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-3 col-md-3 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >Klaster</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="profilpengusul.klaster"
                                                disabled
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >Institusi</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    profilpengusul.institusi
                                                        .nama
                                                "
                                                disabled
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >Program Studi</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    profilpengusul.program_studi
                                                "
                                                disabled
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >ID Sinta</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    profilpengusul.id_sinta
                                                "
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >ID Scholar</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    profilpengusul.id_scholar
                                                "
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >Jenjang Pendidikan</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    profilpengusul.jenjang_pendidikan
                                                "
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >Jabatan Akademik</label
                                            >
                                            <select
                                                class="form-select"
                                                v-model="
                                                    profilpengusul.jabatan_akademik
                                                "
                                            >
                                                <option value="Asisten Ahli">
                                                    Asisten Ahli
                                                </option>
                                                <option value="Lektor">
                                                    Lektor
                                                </option>
                                                <option value="Lektor Kepala">
                                                    Lektor Kepala
                                                </option>
                                                <option value="Profesor">
                                                    Profesor
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >Alamat</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="profilpengusul.alamat"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >Tempat Lahir</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    profilpengusul.tempat_lahir
                                                "
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >Tanggal lahir</label
                                            >
                                            <input
                                                type="date"
                                                class="form-control"
                                                v-model="
                                                    profilpengusul.tanggal_lahir
                                                "
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >No KTP</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="profilpengusul.no_ktp"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >No Telepon</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    profilpengusul.no_telepon
                                                "
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >No HP</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="profilpengusul.no_hp"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >Alamat Email</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    profilpengusul.alamat_surel
                                                "
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6 mt-2">
                                        <div>
                                            <label
                                                for="labelInput"
                                                class="form-label"
                                                >Website Personal</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="
                                                    profilpengusul.website_personal
                                                "
                                                required
                                            />
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <span v-if="isLoading4">
                                <i class="mdi mdi-spin mdi-loading"></i>
                                Loading...
                            </span>
                            <span v-else>
                                <i class="ri-save-line align-bottom me-1"></i>
                                Simpan
                            </span>
                        </button>
                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                        >
                            Keluar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
