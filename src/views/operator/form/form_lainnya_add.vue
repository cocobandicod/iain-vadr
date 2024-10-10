<script setup>
import { ref, defineEmits } from 'vue';
import api from '../../../api';
import { showToast } from '../../../utils/globalFunctions';

const btnloading = ref(false);
const lainnya = ref({
  id: null,
  nama_lainnya: '',
  no_hp: '',
});

const emit = defineEmits(['refreshTabel']);

//method "INSERT"
const add_lainnya = async () => {
  btnloading.value = true;
  let formData = new FormData();
  formData.append('nama_lainnya', lainnya.value.nama_lainnya);
  formData.append('no_hp', lainnya.value.no_hp);
  try {
    await api.post(`/api/lainnya`, formData);
    showToast('Data berhasil disimpan', '#4fbe87');
    emit('refreshTabel');
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
  lainnya.value = {
    id: null,
    nama_lainnya: '',
    no_hp: '',
  };
};
</script>
<template>
  <div
    class="modal fade zoomIn"
    data-bs-backdrop="static"
    id="FormAdd"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    ref="modalRef">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header p-3 bg-success-subtle">
          <h5 class="modal-title" id="createFolderModalLabel">Tambah Data</h5>
        </div>
        <form @submit.prevent="add_lainnya()">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12 mb-2">
                <label class="form-label">Nama</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="lainnya.nama_lainnya"
                  required />
              </div>
              <div class="col-lg-12 mb-2">
                <label for="nameInput" class="form-label">Nomor HP</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="lainnya.no_hp"
                  placeholder="08134371xxxx"
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
