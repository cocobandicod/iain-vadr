<script setup>
import { ref, watch, defineEmits } from 'vue';
import api from '../../../api';
import { showToast } from '../../../utils/globalFunctions';

const btnloading = ref(false);
const group = ref({
  id: null,
  nama_group: '',
});
const props = defineProps({
  dataKet: {
    type: String,
    required: true,
  },
});

const emit = defineEmits(['refresh']);

//method "INSERT"
const add_group = async () => {
  btnloading.value = true;
  let formData = new FormData();
  formData.append('nama_group', group.value.nama_group);
  formData.append('kategori', props.dataKet);
  try {
    await api.post(`/api/addgroup`, formData);
    showToast('Data berhasil disimpan', '#4fbe87');
    emit('refresh');
    clearFormInput();
    // Close modal (optional)
    const modalElement = document.getElementById('FormAddGroup');
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
  group.value = {
    id: null,
    nama_group: '',
  };
};
</script>
<template>
  <div
    class="modal fade zoomIn"
    data-bs-backdrop="static"
    id="FormAddGroup"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    ref="modalRef">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header p-3 bg-success-subtle">
          <h5 class="modal-title" id="createFolderModalLabel">Buat Group</h5>
        </div>
        <form @submit.prevent="add_group()">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12 mb-2">
                <label class="form-label">Nama Group</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="group.nama_group"
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
