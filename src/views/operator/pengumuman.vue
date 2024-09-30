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
const pengumuman = ref([]);

const detail_pengumuman = async () => {
    try {
        const response = await api.get("/api/pengumumanform");
        pengumuman.value = response.data.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    } finally {
        isLoading.value = false;
    }
};

const isFileAvailable = (url) => {
    // Memastikan URL tidak hanya mengarah ke direktori
    return url && !url.endsWith("/storage/pengumuman");
};

onMounted(async () => {
    await detail_pengumuman();
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
                    targets: [0, 4],
                },
                {
                    className: "p-2",
                    targets: [0, 1, 2, 3, 4],
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

const delete_pengumuman = async (id, nama) => {
    // Tampilkan dialog konfirmasi menggunakan SweetAlert
    const result = await confirmDelete("Menghapus data ini?", nama);

    // Jika pengguna mengonfirmasi penghapusan
    if (result.isConfirmed) {
        try {
            // Hapus dari database
            await api.delete(`/api/pengumumanform/${id}`);
            await detail_pengumuman(); // Refresh data setelah penghapusan
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
                                        Pengumuman
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
                                        <router-link
                                            type="button"
                                            class="btn btn-success mb-3"
                                            :to="{
                                                name: 'OperatorPengumumanAdd',
                                            }"
                                        >
                                            <i
                                                class="ri-add-circle-line align-bottom me-1"
                                            ></i>
                                            Pengumuman
                                        </router-link>
                                        <table
                                            id="DTable1"
                                            class="table table-bordered dt-responsive table-striped align-middle fs-12 mb-0"
                                            style="width: 100%"
                                        >
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Judul Pengumuman</th>
                                                    <th>File</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="(
                                                        item, index
                                                    ) in pengumuman"
                                                    :key="index"
                                                >
                                                    <td>{{ index + 1 }}</td>
                                                    <td>
                                                        {{
                                                            item.tgl_pengumuman
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            item.judul_pengumuman
                                                        }}
                                                    </td>
                                                    <td>
                                                        <div
                                                            v-if="
                                                                isFileAvailable(
                                                                    item.file_pengumuman
                                                                )
                                                            "
                                                        >
                                                            <a
                                                                :href="
                                                                    item.file_pengumuman
                                                                "
                                                                class="btn btn-danger btn-label btn-sm rounded-pill"
                                                                target="_blank"
                                                                download
                                                            >
                                                                <i
                                                                    class="ri-file-download-line label-icon align-middle rounded-pill me-2"
                                                                ></i>
                                                                Dokumen
                                                            </a>
                                                        </div>
                                                        <div v-else>
                                                            File Tidak Tersedia
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <span
                                                                class="btn btn-soft-secondary btn-sm dropdown"
                                                                id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"
                                                            >
                                                                <i
                                                                    class="ri-more-2-fill"
                                                                ></i>
                                                            </span>
                                                            <ul
                                                                class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuLink"
                                                            >
                                                                <li>
                                                                    <router-link
                                                                        class="dropdown-item"
                                                                        :to="{
                                                                            name: 'OperatorPengumumanEdit',
                                                                            params: {
                                                                                id: item.id,
                                                                            },
                                                                        }"
                                                                    >
                                                                        <i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"
                                                                        ></i>
                                                                        Ubah
                                                                    </router-link>
                                                                </li>
                                                                <li>
                                                                    <button
                                                                        class="dropdown-item"
                                                                        @click.prevent="
                                                                            delete_pengumuman(
                                                                                item.id,
                                                                                item.judul_pengumuman
                                                                            )
                                                                        "
                                                                    >
                                                                        <i
                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"
                                                                        ></i>
                                                                        Hapus
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
