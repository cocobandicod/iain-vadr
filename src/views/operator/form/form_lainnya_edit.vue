<script setup>
import { ref, watch, defineEmits } from 'vue';
import api from '../../../api';
import { showToast } from '../../../utils/globalFunctions';

const isLoading = ref(true);
const btnloading = ref(false);
const props = defineProps({
  dataId: {
    type: Number,
    required: true,
  },
});

const lainnya = ref({
  id: null,
  nama_lainnya: '',
  no_hp: '',
});

const detail_edit_lainnya = async () => {
  if (!props.dataId) return; // Make sure exists
  try {
    isLoading.value = true;
    const response = await api.get(`/api/lainnya/${props.dataId}`);
    lainnya.value = response.data.data;
  } catch (error) {
    if (error.response && error.response.status === 404) {
      router.push({ name: 'NotFound' });
    } else {
      console.error('Error fetching data:', error);
    }
  } finally {
    isLoading.value = false;
  }
};

const emit = defineEmits(['refreshTabel']);

//method "INSERT"
const update_lainnya = async () => {
  btnloading.value = true;
  let formData = new FormData();
  formData.append('nama_lainnya', lainnya.value.nama_lainnya);
  formData.append('no_hp', lainnya.value.no_hp);
  formData.append('_method', 'PATCH');
  try {
    await api.post(`/api/lainnya/${props.dataId}`, formData);
    showToast('Data berhasil disimpan', '#4fbe87');
    emit('refreshTabel');
    // Close modal (optional)
    const modalElement = document.getElementById('FormEdit');
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

watch(
  () => props.dataId,
  (newId) => {
    if (newId) {
      detail_edit_lainnya(); // Load data whenever Id changes
    }
  }
);
</script>
<template>
  <div
    class="modal fade zoomIn"
    data-bs-backdrop="static"
    id="FormEdit"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    ref="modalRef">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header p-3 bg-success-subtle">
          <h5 class="modal-title" id="createFolderModalLabel">Ubah Data</h5>
        </div>
        <form @submit.prevent="update_lainnya()">
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
