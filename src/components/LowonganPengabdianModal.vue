<script setup>
import { ref, onMounted } from "vue";
import api from "../api";
import "datatables.net-bs5";
import $ from "jquery";
import {
    formatTanggal,
    formatRupiah,
    thnsekarang,
} from "../utils/globalFunctions";

const lowongan = ref([]);
const isLoading = ref(true);
let dataTableInstance = null;

const fetchDataLowongan = async () => {
    try {
        const response = await api.get("/api/lowonganpengabdian");
        lowongan.value = response.data.data.data;
    } catch (error) {
        console.error("Error fetching lowongan data:", error);
    } finally {
        isLoading.value = false;
    }
};

onMounted(async () => {
    await fetchDataLowongan();
    initializeDataTable();
});

const initializeDataTable = () => {
    if ($.fn.dataTable.isDataTable("#DTable2")) {
        $("#DTable2").DataTable().destroy();
    }
    dataTableInstance = $("#DTable2").DataTable({
        stateSave: false,
        autoWidth: true,
        processing: true,
        ordering: false,
        responsive: false,
        columnDefs: [
            {
                className: "text-center p-2",
                width: "3%",
                targets: [0],
            },
            {
                className: "p-2",
                targets: [0, 1, 2, 3, 4, 5, 6, 7],
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
</script>
<template>
    <div
        class="modal fade"
        id="lowonganPengabdianModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-xl w-3">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Lowongan Pengabdian {{ thnsekarang() }}
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <table
                        id="DTable2"
                        class="table table-bordered dt-responsive table-striped align-middle fs-12 mb-0"
                        style="width: 100%"
                    >
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>TA</th>
                                <th>Jenis</th>
                                <th>Quota</th>
                                <th>Pengusul</th>
                                <th>Setuju</th>
                                <th>Total Dana (Rp.)</th>
                                <th>Tanggal Berakhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in lowongan" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.tahun_anggaran }}</td>
                                <td>{{ item.jenis }}</td>
                                <td>{{ item.quota }}</td>
                                <td>{{ item.pengusul }}</td>
                                <td>{{ item.diterima }}</td>
                                <td>{{ formatRupiah(item.total_dana) }}</td>
                                <td>
                                    {{ formatTanggal(item.tgl_berakhir) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
