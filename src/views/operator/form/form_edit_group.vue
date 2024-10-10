<script setup>
import { ref, watch, defineEmits } from 'vue';
import api from '../../../api';
import { showToast } from '../../../utils/globalFunctions';

const isLoading = ref(true);
const btnloading = ref(false);
const group = ref({
  id: null,
  nama_group: '',
});
const props = defineProps({
  dataId: {
    type: String,
    required: true,
  },
  dataKet: {
    type: String,
    required: true,
  },
});

const detail_ = async () => {
  if (!props.dataId) return; // Make sure exists
  try {
    isLoading.value = true;
    const response = await api.get(`/api/detailgroup/${props.dataId}`);
    group.value = response.data.data;
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

const emit = defineEmits(['refresh']);

//method "UPDATE"
const edit_group = async () => {
  btnloading.value = true;
  let formData = new FormData();
  formData.append('nama_group', group.value.nama_group);
  try {
    await api.post(`/api/updategroup/${props.dataId}`, formData);
    showToast('Data berhasil disimpan', '#4fbe87');
    emit('refresh');
    // Close modal (optional)
    const modalElement = document.getElementById('FormEditGroup');
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

watch(
  () => props.dataId,
  (newId) => {
    if (newId) {
      detail_(); // Load data whenever Id changes
    }
  }
);
</script>
<template>
  <div
    class="modal fade zoomIn"
    data-bs-backdrop="static"
    id="FormEditGroup"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    ref="modalRef">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header p-3 bg-success-subtle">
          <h5 class="modal-title" id="createFolderModalLabel">Edit Group</h5>
        </div>
        <form @submit.prevent="edit_group()">
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
                  <label class="form-label">Nama Group</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="group.nama_group"
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
