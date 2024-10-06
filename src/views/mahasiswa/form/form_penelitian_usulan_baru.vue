<script setup>
import { ref, onMounted, watch } from "vue";
import api from "../../../api";

const profilpengusul = ref({});
const isLoading1 = ref(true);
const idUser = ref(localStorage.getItem("id_user"));

const fetchDataProfilPengusul = async () => {
    try {
        const response = await api.get(`/api/profilpengusul/${idUser.value}`);
        profilpengusul.value = response.data.data;
    } catch (error) {
        console.error("Error fetching profil pengusul data:", error);
    } finally {
        isLoading1.value = false;
    }
};
onMounted(() => {
    fetchDataProfilPengusul();
});
</script>
<template>
    <div
        class="modal fade"
        id="FormUsulanBaru"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Info Eligibilitas</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <ul class="list-group">
                            <li
                                class="d-flex justify-content-between list-group-item"
                            >
                                <span>Sinta Score Overall</span
                                ><strong>
                                    {{ profilpengusul.sinta?.sinta_score }}
                                </strong>
                            </li>
                            <li
                                class="d-flex justify-content-between list-group-item"
                            >
                                <span>Klaster</span
                                ><strong>{{ profilpengusul.klaster }}</strong>
                            </li>
                            <li
                                class="d-flex justify-content-between list-group-item"
                            >
                                <span>Jabatan Akademik</span
                                ><strong>{{
                                    profilpengusul.jabatan_akademik
                                }}</strong>
                            </li>
                            <li
                                class="d-flex justify-content-between list-group-item"
                            >
                                <span>Pendidikan Terakhir</span
                                ><strong>{{
                                    profilpengusul.jenjang_pendidikan
                                }}</strong>
                            </li>
                            <li
                                class="d-flex justify-content-between list-group-item"
                            >
                                <span>Status Aktif Mengajar</span
                                ><span
                                    v-if="
                                        profilpengusul.status_mengajar ===
                                        'Aktif'
                                    "
                                    class="badge bg-success"
                                    style="font-size: 12px"
                                >
                                    {{ profilpengusul.status_mengajar }}
                                </span>
                                <span
                                    v-else
                                    class="badge bg-danger"
                                    style="font-size: 12px"
                                >
                                    {{ profilpengusul.status_mengajar }}
                                </span>
                            </li>
                            <li
                                class="d-flex justify-content-between list-group-item"
                            >
                                <span>Kegiatan Sedang Berjalan</span
                                ><strong>0</strong>
                            </li>
                            <li
                                class="d-flex justify-content-between list-group-item"
                            >
                                <span>Tanggungan Laporan Kemajuan </span
                                ><strong>0</strong>
                            </li>
                            <li
                                class="d-flex justify-content-between list-group-item"
                            >
                                <span>Tanggungan Laporan Akhir </span
                                ><strong>0</strong>
                            </li>
                        </ul>
                    </div>
                    <h4 class="fs-14 mb-3 mt-3 text-center">
                        Kegiatan Sedang Berlangsung
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mb-0 fs-13">
                            <thead class="table-light">
                                <tr class="text-muted">
                                    <th>Skema</th>
                                    <th>Judul</th>
                                    <th>Pelaksanaan</th>
                                    <th>Peran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="mt-3">
                        Berdasarkan Eligibilitas yang tercantum, anda dapat
                        mengusulkan dengan Skema berikut:
                    </p>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-primary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
