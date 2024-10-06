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

        <div class="row">
          <div class="col-lg-12">
            <div class="card shadow-none">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-4">
                    <h4 class="text-center mt-3 mb-4">Form Pengaduan</h4>
                    <form action="#">
                      <div class="row g-3">
                        <div class="col-lg-12">
                          <div class="form-floating">
                            <input
                              type="text"
                              class="form-control"
                              id="firstnamefloatingInput"
                              required />
                            <label for="firstnamefloatingInput"
                              >Judul Pengaduan</label
                            >
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-floating">
                            <select
                              class="form-select"
                              id="floatingSelect"
                              aria-label="Floating label select example"
                              required>
                              <option value=""></option>
                              <option value="Rektorat">Rektorat</option>
                              <option value="Perkuliahan">Perkuliahan</option>
                              <option value="Akademik">Akademik</option>
                              <option value="Infrastruktur">
                                Infrastruktur
                              </option>
                              <option value="Event">Event</option>
                              <option value="Ormawa">Ormawa</option>
                              <option value="Lainnya">Lainnya</option>
                            </select>
                            <label for="floatingSelect">Kategori</label>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-floating">
                            <textarea
                              class="form-control"
                              rows="5"
                              id="zipfloatingInput"
                              required></textarea>
                            <label for="zipfloatingInput">Isi Pengaduan</label>
                          </div>
                        </div>
                        <p>*Identitas Nama & Nim akan dijaga kerahasiaanya</p>
                        <div class="col-lg-12">
                          <div class="text-end">
                            <button type="submit" class="btn btn-success">
                              <i class="ri-send-plane-fill me-1"></i>
                              Kirim Pengaduan
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-lg-8">
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
              :to="{ name: 'MahasiswaDashboard' }">
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
