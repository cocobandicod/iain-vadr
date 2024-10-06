<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import 'datatables.net-bs5';
import $ from 'jquery';

let dataTableInstance = null;
const initializeDataTable = () => {
  if ($.fn.dataTable.isDataTable('#DTable')) {
    $('#DTable3').DataTable().destroy();
  }
  dataTableInstance = $('#DTable').DataTable({
    stateSave: false,
    autoWidth: true,
    processing: true,
    ordering: false,
    responsive: false,
    columnDefs: [
      {
        className: 'text-center p-2',
        width: '3%',
        targets: [0],
      },
      {
        className: 'text-center p-2',
        width: '15%',
        targets: [4],
      },
      {
        className: 'p-2',
        targets: [0, 1, 2, 3, 4],
      },
    ],
    language: {
      processing:
        '<span><i class="mdi mdi-spin mdi-loading me-1"></i> Memuat Data..</span>',
      search: "<div class='fs-13 mt-2'>Pencarian</div> _INPUT_",
      searchPlaceholder: 'Masukan Kata Kunci',
      lengthMenu: "<div class='fs-13 mt-2'>Tampilkan</div> _MENU_",
      info: "<div class='fs-13'>Menampilkan _START_ sampai _END_ dari _TOTAL_ entri</div>",
      zeroRecords: 'Tidak ada data yang ditemukan',
      infoEmpty: "<div class='fs-13'>Menampilkan 0 sampai 0 dari 0 entri</div>",
      infoFiltered:
        "<div class='fs-13'>(disaring dari total _MAX_ entri)</div>",
    },
  });
};

onMounted(async () => {
  initializeDataTable();
});

onBeforeUnmount(() => {
  if (dataTableInstance) {
    dataTableInstance.destroy();
  }
});
</script>
<template>
  <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="text-center mb-5">
              <h2 class="mb-3 fw-bold lh-base">Layanan Pengaduan</h2>
              <p class="text-muted">
                Mahasiswa dapat menyampaikan pengaduan terkait fasilitas kampus,
                masalah akademik, atau keluhan lainnya melalui aplikasi ini.
                Pengaduan akan diproses oleh pihak terkait sehingga permasalahan
                bisa ditangani dengan efektif.
              </p>
            </div>
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="card shadow-none">
              <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-xl-12">
                    <h4 class="text-center mt-3 mb-4">
                      Laporan Pengaduan Anda
                    </h4>
                    <table
                      id="DTable"
                      class="table table-bordered dt-responsive table-striped align-middle fs-12 mb-0"
                      style="width: 100%">
                      <thead class="table-light">
                        <tr>
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>Judul</th>
                          <th>Kategori</th>
                          <th>Status Pengaduan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td></td>
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
            <router-link
              class="btn btn-info fs-14 mt-3 mb-4 float-start"
              :to="{ name: 'DosenDashboard' }">
              <i class="ri-arrow-left-line me-1"></i>
              Kembali
            </router-link>
          </div>
        </div>
        <!--end row-->
      </div>
      <!-- end container -->
    </div>
  </div>
  <!-- end features -->
</template>
