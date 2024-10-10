<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api';
import 'datatables.net-bs5';
import $ from 'jquery';
import { showToast, confirmDelete } from '../../utils/globalFunctions';
//import FormAdd from './form/form_pegawai_add.vue';
//import FormEdit from './form/form_pegawai_edit.vue';

const isLoading = ref(true);
const pegawai = ref([]);
const selectedId = ref(0);

const edit_data = (id) => {
  selectedId.value = id;
};

const detail_ = async () => {
  try {
    if ($.fn.DataTable.isDataTable('#DTable')) {
      $('#DTable').DataTable().destroy();
    }
    // Re-initialize DataTable after data is loaded
    initializeDataTable();
    isLoading.value = true; // Set loading to true before fetching
    const response = await api.get('/api/pegawai');
    pegawai.value = response.data.data;
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

const hapus_data = async (id, nama) => {
  // Tampilkan dialog konfirmasi menggunakan SweetAlert
  const result = await confirmDelete('Menghapus data ini?', nama);

  // Jika pengguna mengonfirmasi penghapusan
  if (result.isConfirmed) {
    try {
      // Hapus dari database
      await api.delete(`/api/pegawai/${id}`);
      await detail_(); // Refresh data setelah penghapusan
      initializeDataTable();
      // Tampilkan toast sukses
      showToast('Data berhasil dihapus', '#4fbe87');
    } catch (error) {
      console.error('Error delete data:', error);
      // Tampilkan toast error jika gagal menghapus
      showToast('Gagal menghapus data', '#ff6b6b');
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
                <div class="card-header align-items-center d-flex">
                  <h4 class="card-title mb-0 flex-grow-1">Pegawai</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                  <div>
                    <button
                      type="button"
                      class="btn btn-success mb-2"
                      data-bs-toggle="modal"
                      data-bs-target="#FormAdd">
                      <i class="ri-add-circle-line align-bottom me-1"></i>
                      Data
                    </button>
                  </div>
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
                          <th>NIP</th>
                          <th>Nama Pegawai</th>
                          <th>Nomor HP</th>
                          <th>Fakultas</th>
                          <th>Program Studi</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in pegawai" :key="index">
                          <td>{{ index + 1 }}</td>
                          <td>
                            {{ item.nidn }}
                          </td>
                          <td>
                            {{ item.nama_pegawai }}
                          </td>
                          <td>{{ item.no_hp }}</td>
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
                                    data-bs-target="#FormpegawaiEdit"
                                    @click="edit_data(item.id)">
                                    <i
                                      class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                    Ubah
                                  </button>
                                </li>
                                <li>
                                  <button
                                    class="dropdown-item"
                                    @click.prevent="
                                      hapus_data(item.id, item.nama_pegawai)
                                    ">
                                    <i
                                      class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
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
  <FormAdd @refreshTabel="refreshDataTable" />
  <FormEdit :dataId="selectedId" @refreshTabel="refreshDataTable" />
</template>
<style lang=""></style>
