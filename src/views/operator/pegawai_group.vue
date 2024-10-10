<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api';
import 'datatables.net-bs5';
import $ from 'jquery';
import {
  showToast,
  confirmDelete,
  formatTanggal,
} from '../../utils/globalFunctions';
import FormAddGroup from './form/form_add_group.vue';
import FormEditGroup from './form/form_edit_group.vue';

const isLoading = ref(true);
const group = ref([]);
const kategori = 'Pegawai';
const selectedId = ref('NULL');

const edit_data = (id) => {
  selectedId.value = id;
};

const detail_group = async () => {
  try {
    // Check if DataTable is already initialized, destroy it if exists
    if ($.fn.DataTable.isDataTable('#DTable')) {
      $('#DTable').DataTable().destroy();
    }
    // Re-initialize DataTable after data is loaded
    initializeDataTable();
    isLoading.value = true; // Set loading to true before fetching
    const response = await api.get(`/api/group/${kategori}`);
    group.value = response.data.data.group;
  } catch (error) {
    console.error('Error fetching data:', error);
  } finally {
    isLoading.value = false; // Set loading to false after fetching
  }
};

// Function to initialize DataTable
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
        targets: [0, 5],
      },
      {
        className: 'p-2',
        targets: [0, 1, 2, 3, 4, 5],
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

// Fetch initial data when component is mounted
onMounted(async () => {
  await detail_group();
  initializeDataTable(); // Initialize the data table after fetching
});

const refreshDataTable = async () => {
  await detail_group();
  initializeDataTable();
};

const hapus_data = async (id, nama) => {
  // Tampilkan dialog konfirmasi menggunakan SweetAlert
  const result = await confirmDelete('Menghapus data ini?', nama);

  // Jika pengguna mengonfirmasi penghapusan
  if (result.isConfirmed) {
    try {
      // Hapus dari database
      await api.delete(`/api/hapusgroup/${id}`);
      await detail_group(); // Refresh data setelah penghapusan
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
                  <h4 class="card-title mb-0 flex-grow-1">
                    Kirim Pesan Group Pegawai
                  </h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-auto">
                      <div>
                        <button
                          type="button"
                          class="btn btn-success mb-2 me-1"
                          data-bs-toggle="modal"
                          data-bs-target="#FormAddGroup">
                          <i class="ri-add-circle-line align-bottom me-1"></i>
                          Buat Group
                        </button>
                      </div>
                    </div>
                  </div>
                  <div
                    v-if="isLoading"
                    class="d-flex justify-content-center mt-4 mb-4">
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </div>
                  <div v-else class="mt-3">
                    <div class="row">
                      <div class="table-responsive">
                        <table
                          id="DTable"
                          class="table table-bordered dt-responsive table-striped align-middle fs-12 mb-0"
                          style="width: 100%">
                          <thead class="table-light">
                            <tr>
                              <th>No</th>
                              <th>Kode</th>
                              <th>Nama Group</th>
                              <th>Jumlah Member</th>
                              <th>Create</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in group" :key="index">
                              <td>
                                {{ index + 1 }}
                              </td>
                              <td>
                                <router-link
                                  :to="{
                                    name: 'OperatorPegawaiDetailGroup',
                                    params: {
                                      kode: item.kode,
                                    },
                                  }">
                                  <span class="badge bg-success fs-12">{{
                                    item.kode
                                  }}</span>
                                </router-link>
                              </td>
                              <td>
                                {{ item.nama_group }}
                              </td>
                              <td>{{ item.jumlah_member }}</td>
                              <td>
                                {{ formatTanggal(item.created_at) }}
                              </td>
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
                                        data-bs-target="#FormEditGroup"
                                        @click="edit_data(item.kode)">
                                        <i
                                          class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                        Ubah
                                      </button>
                                    </li>
                                    <li>
                                      <button
                                        class="dropdown-item"
                                        @click.prevent="
                                          hapus_data(item.kode, item.nama_group)
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
  <FormEditGroup
    :dataKet="kategori"
    :dataId="selectedId"
    @refresh="refreshDataTable" />
  <FormAddGroup :dataKet="kategori" @refresh="refreshDataTable" />
</template>
<style lang=""></style>
