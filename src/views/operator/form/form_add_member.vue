<script setup>
import { ref, watch, onMounted, defineEmits, defineProps } from 'vue';
import api from '../../../api';
import 'datatables.net-bs5';
import $ from 'jquery';
import { showToast } from '../../../utils/globalFunctions';

const btnloading = ref(false);
const isLoading = ref(true);
const dataGroup = ref([]);
const props = defineProps({
  dataKet: {
    type: String,
    required: true,
  },
  dataID: {
    type: Number,
    required: true,
  },
});

const emit = defineEmits(['refresh']);

// Check all functionality
const checkedAll = ref(false);

const checkAll = () => {
  const table = $('#DTableMember').DataTable();
  const visibleRows = table.rows({ search: 'applied' }).data().toArray();

  dataGroup.value.forEach((item) => {
    // Check if the item is in the currently visible rows
    const isVisible = visibleRows.some(
      (row) => row[1] === item.nama && row[2] === item.no_hp
    );
    if (isVisible) {
      item.checked = checkedAll.value;
    }
  });
};

const detail_member = async () => {
  try {
    if ($.fn.DataTable.isDataTable('#DTableMember')) {
      $('#DTableMember').DataTable().destroy();
    }
    isLoading.value = true; // Set loading to true before fetching
    const response = await api.get(
      `/api/detailmember/${props.dataKet}/${props.dataID}`
    );
    dataGroup.value = response.data.data.list;
  } catch (error) {
    console.error('Error fetching data:', error);
  } finally {
    isLoading.value = false; // Set loading to false after fetching
  }
};

// Method "INSERT"
const add_member = async () => {
  btnloading.value = true;

  const selectedMembers = dataGroup.value.filter((member) => member.checked);

  if (selectedMembers.length === 0) {
    showToast('Pilih setidaknya satu member', '#ff6b6b');
    btnloading.value = false;
    return;
  }

  try {
    await api.post('/api/addmember', {
      id_group: props.dataID,
      members: selectedMembers.map((member) => ({
        nama: member.nama,
        no_hp: member.no_hp,
      })),
    });

    showToast('Data berhasil disimpan', '#4fbe87');
    emit('refresh');
    // Reset checkboxes
    dataGroup.value.forEach((item) => (item.checked = false));
    checkedAll.value = false;

    // Close the modal
    const modalElement = document.getElementById('FormAddMember');
    const modalInstance = bootstrap.Modal.getInstance(modalElement);
    if (modalInstance) {
      modalInstance.hide();
    }
  } catch (error) {
    console.error('Error adding members:', error);
    showToast('Gagal menyimpan data', '#ff6b6b');
  } finally {
    btnloading.value = false;
  }
};

const initializeDataTable = () => {
  $('#DTableMember').DataTable({
    stateSave: false,
    autoWidth: true,
    processing: true,
    ordering: false,
    responsive: true,
    columnDefs: [
      {
        className: 'text-center p-2',
        targets: [0],
      },
      {
        className: 'p-2',
        targets: [0, 1, 2],
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

onMounted(() => {
  const modalElement = document.getElementById('FormAddMember');
  if (modalElement) {
    modalElement.addEventListener('shown.bs.modal', async () => {
      await detail_member(); // Fetch data when modal is shown
      dataGroup.value.forEach((item) => (item.checked = false));
      checkedAll.value = false;

      // Reinitialize the DataTable after modal is shown
      initializeDataTable();
    });
  }
});

// Watch for individual checkbox changes to update 'Check All' status
watch(
  () => dataGroup.value.map((item) => item.checked),
  (newValues) => {
    checkedAll.value = newValues.every((checked) => checked);
  }
);
</script>

<template>
  <div
    class="modal fade zoomIn"
    data-bs-backdrop="static"
    id="FormAddMember"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    ref="modalRef">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header p-3 bg-success-subtle">
          <h5 class="modal-title" id="createFolderModalLabel">Tambah Member</h5>
        </div>
        <form @submit.prevent="add_member()">
          <div class="modal-body">
            <div
              v-if="isLoading"
              class="d-flex justify-content-center mt-4 mb-4">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
            <div v-else>
              <div class="row">
                <div class="col-lg-12 mb-2">
                  <table
                    id="DTableMember"
                    class="table table-bordered dt-responsive table-striped align-middle fs-12 mb-0"
                    style="width: 100%">
                    <thead class="table-light">
                      <tr>
                        <th>
                          <input
                            type="checkbox"
                            class="form-check-input"
                            v-model="checkedAll"
                            @change="checkAll" />
                        </th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in dataGroup" :key="index">
                        <td>
                          <input
                            type="checkbox"
                            class="form-check-input"
                            v-model="item.checked" />
                        </td>
                        <td>{{ item.nama }}</td>
                        <td>{{ item.no_hp }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-success">
              <span v-if="btnloading">
                <i class="mdi mdi-spin mdi-loading"></i>
                Loading...
              </span>
              <span v-else>
                <i class="ri-save-line align-bottom me-1"></i>
                Tambah
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<style lang=""></style>
