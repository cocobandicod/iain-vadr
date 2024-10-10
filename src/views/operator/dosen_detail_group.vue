<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import api from '../../api';
import 'datatables.net-bs5';
import $ from 'jquery';
import {
  showToast,
  confirmDelete,
  formatTanggal,
} from '../../utils/globalFunctions';
import FormKirimPesan from './form/form_kirim_pesan.vue';
import FormAddMember from './form/form_add_member.vue';
import FormKirimBroadcast from './form/form_kirim_broadcast.vue';

const route = useRoute();
const isLoading = ref(true);
const group = ref([]);
const member = ref([]);
const dataGroup = ref([]);
const kategori = 'Dosen';
const dataID = ref(null);

const jumMember = ref(0);
const namaGroup = ref('');

const selectedNama = ref('');
const selectedNomor = ref('');

const edit_data = (nama, nomor) => {
  selectedNama.value = nama;
  selectedNomor.value = nomor;
};

const detail_group = async () => {
  try {
    initializeDataTable();
    isLoading.value = true; // Set loading to true before fetching
    const response = await api.get(
      `/api/group/${kategori}/${route.params.kode}`
    );
    member.value = response.data.data.member;
    group.value = response.data.data.group;
    dataID.value = group.value.id;
    jumMember.value = response.data.data.jum;
    namaGroup.value = group.value.nama_group;

    // Initialize DataTable after data is loaded
  } catch (error) {
    console.error('Error fetching data:', error);
  } finally {
    isLoading.value = false; // Set loading to false after fetching
  }
};

// Function to initialize DataTable
const initializeDataTable = () => {
  if ($.fn.DataTable.isDataTable('#DTable')) {
    $('#DTable').DataTable().clear().destroy();
  }
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
  initializeDataTable();
});

// Refresh DataTable after adding a member
const refreshDataTable = async () => {
  await detail_group();
  initializeDataTable();
};

const resetModalData = () => {
  // Reset checked status for all items in dataGroup
  dataGroup.value.forEach((item) => {
    item.checked = false; // Reset checkbox status
  });
};

const hapus_data = async (id, nama) => {
  // Tampilkan dialog konfirmasi menggunakan SweetAlert
  const result = await confirmDelete('Menghapus data ini?', nama);

  // Jika pengguna mengonfirmasi penghapusan
  if (result.isConfirmed) {
    try {
      // Hapus dari database
      await api.delete(`/api/hapusmember/${id}`);
      showToast('Data berhasil dihapus', '#4fbe87');
      await detail_group(); // Refresh data setelah penghapusan
      initializeDataTable();
    } catch (error) {
      console.error('Error delete data:', error);
      showToast('Gagal menghapus data', '#ff6b6b');
    }
  }
};

// Listen for the modal open event
onMounted(() => {
  const modalElement = document.getElementById('FormAddMember');
  if (modalElement) {
    modalElement.addEventListener('show.bs.modal', resetModalData);
  }
});
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
                    Kirim Pesan Group Dosen ({{ namaGroup }})
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
                          data-bs-target="#FormAddMember">
                          <i class="ri-user-add-line align-bottom me-1"></i>
                          Tambah Member
                        </button>
                        <button
                          type="button"
                          class="btn btn-success mb-2 me-1"
                          data-bs-toggle="modal"
                          data-bs-target="#FormAddMember">
                          <i class="ri-file-upload-line align-bottom me-1"></i>
                          Upload Excel
                        </button>
                        <button
                          type="button"
                          class="btn btn-success mb-2 me-1"
                          data-bs-toggle="modal"
                          data-bs-target="#FormKirimBroadcast">
                          <i class="ri-mail-send-line align-bottom me-1"></i>
                          Kirim Broadcast
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
                              <th>Nama</th>
                              <th>Nomor HP</th>
                              <th>Group</th>
                              <th>Create</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in member" :key="index">
                              <td>
                                {{ index + 1 }}
                              </td>
                              <td>
                                {{ item.nama }}
                              </td>
                              <td>{{ item.no_hp }}</td>
                              <td>{{ group.nama_group }}</td>
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
                                        data-bs-target="#FormKirimPesan"
                                        @click="
                                          edit_data(item.nama, item.no_hp)
                                        ">
                                        <i
                                          class="ri-mail-send-line align-bottom me-2 text-muted"></i>
                                        Kirim Pesan
                                      </button>
                                    </li>
                                    <li>
                                      <button
                                        class="dropdown-item"
                                        @click.prevent="
                                          hapus_data(item.id, item.nama)
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
  <FormKirimPesan :selectedNama="selectedNama" :selectedNomor="selectedNomor" />
  <FormAddMember
    :dataKet="kategori"
    :dataID="dataID || 0"
    @refresh="refreshDataTable" />
  <FormKirimBroadcast
    :dataKet="kategori"
    :dataID="dataID || 0"
    :namaGroup="namaGroup"
    :jumMember="jumMember" />
</template>
<style lang=""></style>
