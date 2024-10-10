<script setup>
import { ref, onMounted, defineEmits } from 'vue';
import api from '../../../api';
import { showToast } from '../../../utils/globalFunctions';

const btnloading = ref(false);
const fakultasList = ref([]);
const jurusanList = ref([]);
const dosen = ref({
  id: null,
  id_fakultas: '',
  id_prodi: '',
  nidn: '',
  nama_dosen: '',
  no_hp: '',
  jabatan: '',
  email: '',
});

const emit = defineEmits(['refresh']);

const fetchFakultas = async () => {
  try {
    const response = await api.get('/api/fakultas');
    fakultasList.value = response.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

const fetchJurusan = async () => {
  if (dosen.value.id_fakultas) {
    try {
      const response = await api.get(`/api/jurusan/${dosen.value.id_fakultas}`);
      jurusanList.value = response.data;
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }
};

//method "INSERT"
const add_ = async () => {
  btnloading.value = true;
  let formData = new FormData();
  formData.append('id_fakultas', dosen.value.id_fakultas);
  formData.append('id_prodi', dosen.value.id_prodi);
  formData.append('nidn', dosen.value.nidn);
  formData.append('nama_dosen', dosen.value.nama_dosen);
  formData.append('no_hp', dosen.value.no_hp);
  formData.append('jabatan', dosen.value.jabatan);
  formData.append('email', dosen.value.email);
  try {
    await api.post(`/api/dosen`, formData);
    showToast('Data berhasil disimpan', '#4fbe87');
    emit('refresh');
    clearFormInput();
    // Close modal (optional)
    const modalElement = document.getElementById('FormAdd');
    const modalInstance = bootstrap.Modal.getInstance(modalElement);
    if (modalInstance) {
      modalInstance.hide();
    }
  } catch (error) {
    console.error('Error updating data:', error);
    showToast('Gagal menyimpan data', '#ff6b6b');
  } finally {
    btnloading.value = false;
  }
};

const clearFormInput = () => {
  dosen.value = {
    id: null,
    id_fakultas: '',
    id_prodi: '',
    nidn: '',
    nama_dosen: '',
    no_hp: '',
    jabatan: '',
    email: '',
  };
  jurusanList.value = '';
};

onMounted(() => {
  const modalElement = document.getElementById('FormAdd');
  const handleShown = async () => {
    await fetchFakultas(); // Fetch data when modal is shown
  };

  if (modalElement) {
    modalElement.addEventListener('shown.bs.modal', handleShown);
  }

  return () => {
    if (modalElement) {
      modalElement.removeEventListener('shown.bs.modal', handleShown);
    }
  };
});
</script>
<template>
  <div
    class="modal fade zoomIn modal-md"
    data-bs-backdrop="static"
    id="FormAdd"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    ref="modalRef">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header p-3 bg-success-subtle">
          <h5 class="modal-title" id="createFolderModalLabel">
            Tambah Data Dosen
          </h5>
        </div>
        <form @submit.prevent="add_()">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12 mb-2">
                <label class="form-label">NIDN</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="dosen.nidn"
                  required />
              </div>
              <div class="col-lg-12 mb-2">
                <label class="form-label">Nama Dosen</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="dosen.nama_dosen"
                  required />
              </div>
              <div class="col-lg-12 mb-2">
                <label class="form-label">Nomor HP</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="dosen.no_hp"
                  required />
              </div>
              <div class="col-lg-12 mb-2">
                <label class="form-label">Fakultas</label>
                <select
                  class="form-select"
                  v-model="dosen.id_fakultas"
                  @change="fetchJurusan">
                  <option value="" disabled>Pilih--</option>
                  <option
                    v-for="fak in fakultasList"
                    :key="fak.id"
                    :value="fak.id">
                    {{ fak.nama_fakultas }}
                  </option>
                </select>
              </div>
              <div class="col-lg-12 mb-2">
                <label class="form-label">Jurusan</label>
                <select
                  class="form-select"
                  v-model="dosen.id_prodi"
                  :disabled="jurusanList.length === 0">
                  <option value="" disabled v-if="jurusanList.length === 0">
                    Pilih Jurusan --
                  </option>
                  <option
                    v-for="jur in jurusanList"
                    :key="jur.id"
                    :value="jur.id">
                    {{ jur.nama_jurusan }}
                  </option>
                </select>
              </div>
              <div class="col-lg-6 mb-2">
                <label class="form-label">Jabatan</label>
                <select class="form-select" v-model="dosen.jabatan">
                  <option value="" disabled>Pilih --</option>
                  <option value="Ketua-Jurusan">Ketua Jurusan</option>
                  <option value="Sekretaris-Jurusan">Sekretaris Jurusan</option>
                  <option value="Dosen">Dosen</option>
                </select>
              </div>
              <div class="col-lg-6 mb-2">
                <label class="form-label">Email</label>
                <input
                  type="email"
                  class="form-control"
                  v-model="dosen.email"
                  required />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-light"
              data-bs-dismiss="modal"
              @click="clearFormInput">
              Close
            </button>
            <button type="submit" class="btn btn-success">
              <span v-if="btnloading">
                <i class="mdi mdi-spin mdi-loading"></i>
                Loading...
              </span>
              <span v-else>
                <i class="ri-save-line align-bottom me-1"></i>
                Simpan
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<style lang=""></style>
