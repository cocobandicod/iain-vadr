<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api';
import 'datatables.net-bs5';
import $ from 'jquery';
import { formatTanggal } from '../../utils/globalFunctions';

const isLoading = ref(true);
const report = ref([]);

const detail_ = async (kat, page = 1, limit = 10) => {
  try {
    if ($.fn.DataTable.isDataTable('#DTable')) {
      $('#DTable').DataTable().destroy();
    }

    // Re-initialize DataTable after data is loaded
    initializeDataTable();
    isLoading.value = true; // Set loading to true before fetching

    // Request API with kat, page, and limit parameters
    const response = await api.get(`/api/reportpesan/${kat}`, {
      params: {
        page: page,
        limit: limit,
      },
    });

    report.value = response.data.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(async () => {
  await detail_('Lainnya');
  initializeDataTable();
});

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
        targets: [0],
      },
      {
        className: 'p-2',
        targets: [0, 1, 2, 3, 4],
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
                  <h4 class="card-title mb-0 flex-grow-1">Report Pesan</h4>
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
                          <th>Tanggal Kirim</th>
                          <th>Nama</th>
                          <th>Nomor HP</th>
                          <th>Group/Personal</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in report" :key="index">
                          <td>{{ index + 1 }}</td>
                          <td>
                            {{ formatTanggal(item.tanggal_kirim) }}
                          </td>
                          <td>{{ item.nama }}</td>
                          <td>{{ item.no_hp }}</td>
                          <td>{{ item.nama_group }}</td>
                          <td>
                            <div v-if="item.status == 'sent'">
                              <span class="badge bg-info fs-11">Terkirim</span>
                            </div>
                            <div v-else-if="item.status == 'read'">
                              <span class="badge bg-success fs-11">Dibaca</span>
                            </div>
                            <div v-else-if="item.status == 'pending'">
                              <span class="badge bg-warning fs-11"
                                >Pending</span
                              >
                            </div>
                            <div v-else-if="item.status == 'cancel'">
                              <span class="badge bg-danger fs-11">Gagal</span>
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
