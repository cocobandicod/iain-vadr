<script setup>
import { ref, watch } from 'vue';
import api from '../../../api';
import { showToast } from '../../../utils/globalFunctions';

const btnloading = ref(false);
const body = ref('');
const props = defineProps({
  selectedNomor: {
    type: String,
    required: true,
  },
  selectedNama: {
    type: String,
    required: true,
  },
});

//method "INSERT"
const kirim = async () => {
  btnloading.value = true;
  let formData = new FormData();
  formData.append('nama', props.selectedNama);
  formData.append('no_hp', props.selectedNomor);
  formData.append('body', body.value);
  try {
    await api.post(`/api/kirimpesan`, formData);
    showToast('Kirim Broadcast Berhasil', '#4fbe87');
    // Close modal (optional)
    const modalElement = document.getElementById('FormKirimPesan');
    const modalInstance = bootstrap.Modal.getInstance(modalElement);
    if (modalInstance) {
      modalInstance.hide();
    }
  } catch (error) {
    console.error('Error updating data:', error);
    showToast('Gagal Mengirim Pesan', '#ff6b6b');
  } finally {
    btnloading.value = false;
    body.value = '';
  }
};
</script>
<template>
  <div
    class="modal fade zoomIn"
    data-bs-backdrop="static"
    id="FormKirimPesan"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    ref="modalRef">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header p-3 bg-success-subtle">
          <h5 class="modal-title" id="createFolderModalLabel">Kirim Pesan</h5>
        </div>
        <form @submit.prevent="kirim()">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12 mb-2">
                <label class="form-label">Nama</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="props.selectedNama"
                  disabled />
              </div>
              <div class="col-lg-12 mb-2">
                <label class="form-label">Nomor Telepon</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="props.selectedNomor"
                  disabled />
              </div>
              <div class="col-lg-12 mb-2">
                <label class="form-label">Body Pesan</label>
                <textarea
                  class="form-control"
                  v-model="body"
                  required></textarea>
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
                <i class="ri-send-plane-line align-bottom me-1"></i>
                Kirim
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<style lang=""></style>
