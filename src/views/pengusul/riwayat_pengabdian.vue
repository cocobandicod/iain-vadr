<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import api from "../../api";
import "datatables.net-bs5";
import $ from "jquery";
import FormUsulanBaru from "./form/form_penelitian_usulan_baru.vue";

const lowongan = ref([]);
const isLoading = ref(true);
let dataTableInstance = null;

const fetchDataLowongan3 = async () => {
    try {
        const response = await api.get("/api/lowonganpenelitian");
        lowongan.value = response.data.data.data;
    } catch (error) {
        console.error("Error fetching lowongan data:", error);
    } finally {
        isLoading.value = false;
    }
};

const initializeDataTable3 = () => {
    if ($.fn.dataTable.isDataTable("#DTable3")) {
        $("#DTable3").DataTable().destroy();
    }
    dataTableInstance = $("#DTable3").DataTable({
        stateSave: false,
        autoWidth: true,
        processing: true,
        ordering: false,
        responsive: false,
        columnDefs: [
            {
                className: "text-center p-2",
                width: "3%",
                targets: [0, 3],
            },
            {
                className: "p-2",
                targets: [0, 1, 2, 3],
            },
        ],
        language: {
            processing:
                '<span><i class="mdi mdi-spin mdi-loading me-1"></i> Memuat Data..</span>',
            search: "<div class='fs-13 mt-2'>Pencarian</div> _INPUT_",
            searchPlaceholder: "Masukan Kata Kunci",
            lengthMenu: "<div class='fs-13 mt-2'>Tampilkan</div> _MENU_",
            info: "<div class='fs-13'>Menampilkan _START_ sampai _END_ dari _TOTAL_ entri</div>",
            zeroRecords: "Tidak ada data yang ditemukan",
            infoEmpty:
                "<div class='fs-13'>Menampilkan 0 sampai 0 dari 0 entri</div>",
            infoFiltered:
                "<div class='fs-13'>(disaring dari total _MAX_ entri)</div>",
        },
    });
};

onMounted(async () => {
    await fetchDataLowongan3();
    initializeDataTable3();
});

onBeforeUnmount(() => {
    if (dataTableInstance) {
        dataTableInstance.destroy();
    }
});
</script>
<template lang="">
    <div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between"
                            >
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">
                                        Riwayat Pengabdian
                                    </h4>
                                    <p class="text-muted mb-0">
                                        Riwayat Pengabdian Dosen
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div>
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
                                                <div class="col-sm-3">
                                                    <select
                                                        class="form-select"
                                                        aria-label="Default select example"
                                                    >
                                                        <option selected>
                                                            Status Didanai ---
                                                        </option>
                                                        <option value="1">
                                                            Semua
                                                        </option>
                                                        <option value="2">
                                                            Didanai
                                                        </option>
                                                        <option value="3">
                                                            Tidak Didanai
                                                        </option>
                                                    </select>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <table
                                                id="DTable3"
                                                class="table table-bordered dt-responsive table-striped align-middle fs-12 mb-0"
                                                style="width: 100%"
                                            >
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tahun</th>
                                                        <th>Judul</th>
                                                        <th>Status</th>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row-->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
    </div>
</template>
