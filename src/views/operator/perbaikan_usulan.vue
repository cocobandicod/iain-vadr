<script setup>
import { ref, onMounted } from "vue";
import api from "../../api";
import "datatables.net-bs5";
import $ from "jquery";
import {
    showToast,
    showAlert,
    confirmDelete,
} from "../../utils/globalFunctions";

const isLoading = ref(true);
const tautan = ref([]);

const detail_tautan = async () => {
    try {
        const response = await api.get("/api/tautanform");
        tautan.value = response.data.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    } finally {
        isLoading.value = false;
    }
};

onMounted(async () => {
    await detail_tautan();
    initializeDataTable();
});

const initializeDataTable = () => {
    $(document).ready(function () {
        $("#DTable1").DataTable({
            stateSave: true,
            autoWidth: true,
            processing: true,
            ordering: false,
            responsive: true,
            columnDefs: [
                {
                    className: "text-center p-2",
                    width: "3%",
                    targets: [0],
                },
                {
                    className: "text-center p-2",
                    width: "10%",
                    targets: [2],
                },
                {
                    className: "p-2",
                    targets: [0, 1, 2],
                },
            ],
            language: {
                processing:
                    '<span><i class="mdi mdi-spin mdi-loading me-1"></i> Memuat Data..</span>',
                search: "<div class='fs-13'>Pencarian</div> _INPUT_",
                searchPlaceholder: "Masukan Kata Kunci",
                lengthMenu: "<div class='fs-13'>Tampilkan</div> _MENU_",
                info: "<div class='fs-13'>Menampilkan _START_ sampai _END_ dari _TOTAL_ entri</div>",
                zeroRecords: "Tidak ada data yang ditemukan",
                infoEmpty:
                    "<div class='fs-13'>Menampilkan 0 sampai 0 dari 0 entri</div>",
                infoFiltered:
                    "<div class='fs-13'>(disaring dari total _MAX_ entri)</div>",
            },
        });
    });
};

const delete_tautan = async (id, nama) => {
    // Tampilkan dialog konfirmasi menggunakan SweetAlert
    const result = await confirmDelete("Menghapus data ini?", nama);

    // Jika pengguna mengonfirmasi penghapusan
    if (result.isConfirmed) {
        try {
            // Hapus dari database
            await api.delete(`/api/tautanform/${id}`);
            await detail_tautan(); // Refresh data setelah penghapusan
            // Tampilkan toast sukses
            showToast("Data berhasil dihapus", "#4fbe87");
        } catch (error) {
            console.error("Error delete data:", error);
            // Tampilkan toast error jika gagal menghapus
            showToast("Gagal menghapus data", "#ff6b6b");
        }
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
                                        Perbaikan Usulan
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
                                        <div class="row">
                                            <div
                                                class="col-xxl-3 col-md-3 mt-0 mb-2"
                                            >
                                                <div>
                                                    <label
                                                        for="labelInput"
                                                        class="form-label"
                                                        >Jenis Kegiatan</label
                                                    >
                                                    <select
                                                        class="form-select"
                                                        selected
                                                    >
                                                        <option value="">
                                                            Pilih --
                                                        </option>
                                                        <option
                                                            value="Penelitian"
                                                        >
                                                            Penelitian
                                                        </option>
                                                        <option
                                                            value="Pengabdian"
                                                        >
                                                            Pengabdian
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div
                                                class="col-xxl-2 col-md-2 mt-0 mb-2"
                                            >
                                                <div>
                                                    <label
                                                        for="labelInput"
                                                        class="form-label"
                                                        >Tahun
                                                        Pelaksanaan</label
                                                    >
                                                    <select
                                                        class="form-select"
                                                        selected
                                                    >
                                                        <option value="">
                                                            Pilih --
                                                        </option>
                                                        <option
                                                            value="Penelitian"
                                                        >
                                                            Penelitian
                                                        </option>
                                                        <option
                                                            value="Pengabdian"
                                                        >
                                                            Pengabdian
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table
                                                    id="DTable1"
                                                    class="table table-bordered dt-responsive table-striped align-middle fs-12 mb-0"
                                                    style="width: 100%"
                                                >
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Usulan</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="(
                                                                item, index
                                                            ) in tautan"
                                                            :key="index"
                                                        >
                                                            <td>
                                                                {{ index + 1 }}
                                                            </td>
                                                            <td>
                                                                <div
                                                                    class="d-flex mb-0"
                                                                >
                                                                    <div
                                                                        class="flex-grow-1"
                                                                    >
                                                                        <p
                                                                            class="text-truncate mb-0 fs-13"
                                                                        >
                                                                            <i
                                                                                class="mdi mdi-circle align-middle text-primary me-2"
                                                                            ></i
                                                                            ><b
                                                                                >Pengembangan
                                                                                Alat
                                                                                Bantu
                                                                                Ergonomis
                                                                                Untuk
                                                                                Perempuan
                                                                                Pengrajin
                                                                                Karawo
                                                                            </b>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex mb-0"
                                                                >
                                                                    <div
                                                                        class="flex-grow-1"
                                                                    >
                                                                        <p
                                                                            class="text-success-emphasis mb-0"
                                                                        >
                                                                            Skema
                                                                            Penelitian
                                                                            Fundamental
                                                                            -
                                                                            Reguler
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex mb-0"
                                                                >
                                                                    <div
                                                                        class="flex-grow-1"
                                                                    >
                                                                        Ketua :
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex mb-0"
                                                                >
                                                                    <div
                                                                        class="flex-grow-1"
                                                                    >
                                                                        Tahun
                                                                        Pelaksanaan
                                                                        :
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex mb-0"
                                                                >
                                                                    <div
                                                                        class="flex-grow-1"
                                                                    >
                                                                        Bidang
                                                                        Fokus :
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex mb-0"
                                                                >
                                                                    <div
                                                                        class="flex-grow-1"
                                                                    >
                                                                        Jumlah
                                                                        Anggota
                                                                        :
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex mb-0"
                                                                >
                                                                    <div
                                                                        class="flex-grow-1"
                                                                    >
                                                                        Lama
                                                                        Kegiatan
                                                                        :
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex mb-0"
                                                                >
                                                                    <div
                                                                        class="flex-grow-1"
                                                                    >
                                                                        Tanggal
                                                                        Perbaikan
                                                                        :
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex mb-0"
                                                                >
                                                                    <div
                                                                        class="flex-grow-1"
                                                                    >
                                                                        Dana
                                                                        Disetujui
                                                                        :
                                                                        <b
                                                                            class="text-success-emphasis"
                                                                            >Rp.
                                                                            100.000.000
                                                                        </b>
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="badge rounded-pill bg-success fs-11"
                                                                    >Submitted</span
                                                                >
                                                            </td>
                                                            <td>
                                                                <router-link
                                                                    type="button"
                                                                    class="btn btn-soft-secondary btn-sm"
                                                                    :to="{
                                                                        name: 'OperatorPerbaikanUsulanDetail',
                                                                    }"
                                                                >
                                                                    <i
                                                                        class="ri-search-line align-bottom me-0"
                                                                    ></i>
                                                                    View
                                                                </router-link>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
