<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api';
import 'datatables.net-bs5';
import $ from 'jquery';
import FormKirimPesan from './form/form_kirim_pesan.vue';

const isLoading = ref(true);
const mahasiswa = ref([]);
const selectedNama = ref('');
const selectedNomor = ref('');

const edit_data = (nama, nomor) => {
  selectedNama.value = nama;
  selectedNomor.value = nomor;
};

const detail_ = async () => {
  try {
    if ($.fn.DataTable.isDataTable('#DTable')) {
      $('#DTable').DataTable().destroy();
    }
    // Re-initialize DataTable after data is loaded
    initializeDataTable();
    isLoading.value = true; // Set loading to true before fetching
    const response = await api.get('/api/mahasiswa');
    mahasiswa.value = response.data.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(async () => {
  await detail_();
  initializeDataTable();
});

const refreshDataTable = async () => {
  await detail_();
  initializeDataTable();
};

const initializeDataTable = () => {
  $('#DTable').DataTable({
    stateSave: true,
    autoWidth: true,
    processing: true,
    ordering: false,
    responsive: true,
    columnDefs: [
      {
        className: 'text-center p-2',
        width: '3%',
        targets: [0, 6],
      },
      {
        className: 'p-2',
        targets: [0, 1, 2, 3, 4, 5, 6],
      },
    ],
    language: {
      processing:
        '<span><i class="mdi mdi-spin mdi-loading me-1"></i> Memuat Data..</span>',
      search: "<div class='fs-13'>Pencarian</div> _INPUT_",
      searchPlaceholder: 'Masukan Kata Kunci',
      lengthMenu: "<div class='fs-13'>Tampilkan</div> _MENU_",
      info: "<div class='fs-13'>Menampilkan _START_ sampai _END_ dari _TOTAL_ entri</div>",
      zeroRecords: 'Tidak ada data yang ditemukan',
      infoEmpty: "<div class='fs-13'>Menampilkan 0 sampai 0 dari 0 entri</div>",
      infoFiltered:
        "<div class='fs-13'>(disaring dari total _MAX_ entri)</div>",
    },
  });
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
                <div class="card-header align-items-center d-flex">
                  <h4 class="card-title mb-0 flex-grow-1">
                    Pesan Baru Orang Tua Mahasiswa
                  </h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                  <div
                    v-if="isLoading"
                    class="d-flex justify-content-center mt-4 mb-4">
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </div>
                  <div v-else>
                    <table
                      id="DTable"
                      class="table table-bordered dt-responsive table-striped align-middle fs-12 mb-0"
                      style="width: 100%">
                      <thead class="table-light">
                        <tr>
                          <th>No</th>
                          <th>NIM</th>
                          <th>Nama Mahasiswa</th>
                          <th>No. HP Orang Tua</th>
                          <th>Fakultas</th>
                          <th>Program Studi</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in mahasiswa" :key="index">
                          <td>{{ index + 1 }}</td>
                          <td>
                            {{ item.nim }}
                          </td>
                          <td>
                            {{ item.nama_mahasiswa }}
                          </td>
                          <td>{{ item.no_hp_orangtua }}</td>
                          <td>{{ item.nama_fakultas }}</td>
                          <td>{{ item.nama_jurusan }}</td>
                          <td>
                            <div class="dropdown">
                              <span
                                class="btn btn-soft-secondary btn-sm dropdown"
                                id="dropdownMenuLink"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ri-more-2-fill"></i>
                              </span>
                              <ul
                                class="dropdown-menu"
                                aria-labelledby="dropdownMenuLink">
                                <li>
                                  <button
                                    class="dropdown-item"
                                    data-bs-toggle="modal"
                                    data-bs-target="#FormKirimPesan"
                                    @click="
                                      edit_data(
                                        item.nama_mahasiswa,
                                        item.no_hp_orangtua
                                      )
                                    ">
                                    <i
                                      class="ri-mail-send-line align-bottom me-2 text-muted"></i>
                                    Kirim Pesan
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
  <FormKirimPesan :selectedNama="selectedNama" :selectedNomor="selectedNomor" />
</template>
<style lang=""></style>
