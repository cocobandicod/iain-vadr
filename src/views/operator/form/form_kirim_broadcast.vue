<script setup>
import { ref, watch } from 'vue';
import api from '../../../api';
import { showToast } from '../../../utils/globalFunctions';

const btnloading = ref(false);
const body = ref('');
const props = defineProps({
  dataID: {
    type: Number,
    required: true,
  },
  jumMember: {
    type: Number,
    required: true,
  },
  namaGroup: {
    type: String,
    required: true,
  },
});

//method "INSERT"
const kirim = async () => {
  btnloading.value = true;
  let formData = new FormData();
  formData.append('id_group', props.dataID);
  formData.append('body', body.value);
  try {
    await api.post(`/api/kirimbroadcast`, formData);
    showToast('Kirim Broadcast Berhasil', '#4fbe87');
    // Close modal (optional)
    const modalElement = document.getElementById('FormKirimBroadcast');
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
    id="FormKirimBroadcast"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    ref="modalRef">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header p-3 bg-success-subtle">
          <h5 class="modal-title" id="createFolderModalLabel">
            Kirim Broadcast
          </h5>
        </div>
        <form @submit.prevent="kirim()">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12 mb-2">
                <label class="form-label">Nama Group</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="props.namaGroup"
                  disabled />
              </div>
              <div class="col-lg-12 mb-2">
                <label class="form-label">Jumlah Member</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="props.jumMember"
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
