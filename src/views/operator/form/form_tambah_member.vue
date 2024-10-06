<script setup>
import { ref, watch, onMounted, defineEmits } from 'vue';
import api from '../../../api';
import { showToast } from '../../../utils/globalFunctions';
import Choices from 'choices.js';

const btnloading = ref(false);
const isLoading = ref(true);
const member = ref([]);
const group = ref([]);
const pilgroup = ref('');
const pilmember = ref('');
const tambahmember = ref({
  id: null,
  nama: '',
  no_hp: '',
});
const props = defineProps({
  dataKet: {
    type: String,
    required: true,
  },
  groupData: {
    type: Array,
    required: true,
  },
});

const emit = defineEmits(['refresh']);

//method "DETAIL"
const detailgroup = async () => {
  try {
    isLoading.value = true; // Set loading to true before fetching
    const response = await api.get(`/api/detailmember/${props.dataKet}`);
    member.value = response.data.data.member;
    group.value = response.data.data.group;
  } catch (error) {
    console.error('Error fetching data:', error);
  } finally {
    isLoading.value = false; // Set loading to false after fetching
  }
};

// Watcher untuk mendeteksi perubahan pada `pilmember`
watch(pilmember, (newValue) => {
  if (newValue === '') {
    // Jika memilih "Pilih --", kosongkan nomor HP
    tambahmember.value.no_hp = '';
  } else {
    // Jika member dipilih, cari nomor HP dari member yang sesuai
    const selectedMember = member.value.find(
      (mbr) => mbr.nama_lainnya === newValue
    );
    if (selectedMember) {
      tambahmember.value.no_hp = selectedMember.no_hp;
    }
  }
});

//method "INSERT"
const add_member = async () => {
  if (pilgroup.value === '') {
    showToast('Nama group harus dipilih', '#ff6b6b');
    return;
  } else if (pilmember.value === '') {
    showToast('Nama member harus dipilih', '#ff6b6b');
    return;
  }

  btnloading.value = true;
  let formData = new FormData();
  formData.append('id_group', pilgroup.value);
  formData.append('nama', pilmember.value);
  formData.append('no_hp', tambahmember.value.no_hp);
  try {
    await api.post(`/api/tambahmember`, formData);
    showToast('Data berhasil disimpan', '#4fbe87');
    emit('refresh');
    clearFormInput();
    // Close modal (optional)
    const modalElement = document.getElementById('FormTambahMember');
    const modalInstance = bootstrap.Modal.getInstance(modalElement);
    if (modalInstance) {
      modalInstance.hide();
    }
  } catch (error) {
    console.error('Error updating data:', error);
    showToast('Gagal menyimpan data', '#ff6b6b');
  } finally {
    btnloading.value = false;
    pilgroup.value = '';
    pilmember.value = '';
  }
};

const clearFormInput = () => {
  tambahmember.value = {
    id: null,
    pilgroup: null,
  };
};

onMounted(async () => {
  await detailgroup();
  // Inisialisasi Choices.js untuk dropdown `pilgroup` dan `pilmember`
  const memberSelect = document.querySelector('[data-choices="member"]');

  if (memberSelect) {
    new Choices(memberSelect, {
      searchEnabled: true, // Bisa diaktifkan jika ingin fitur search
      itemSelectText: '',
    });
  }
});
</script>
<template>
  <div
    class="modal fade zoomIn modal-md"
    data-bs-backdrop="static"
    id="FormTambahMember"
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
            <div class="row">
              <div class="col-lg-12 mb-2">
                <label class="form-label">Nama Group</label>
                <select v-model="pilgroup" class="form-select">
                  <option value="">Pilih --</option>
                  <option
                    v-for="(item, index) in groupData"
                    :key="index"
                    :value="item.id">
                    {{ item.nama_group }}
                  </option>
                </select>
              </div>
              <div class="col-lg-12 mb-2">
                <label class="form-label">Nama Member</label>
                <select
                  v-model="pilmember"
                  class="form-select"
                  data-choices="member"
                  name="pilmember">
                  <option value="">Pilih --</option>
                  <option
                    v-for="mbr in member"
                    :key="mbr.id"
                    :value="mbr.nama_lainnya">
                    {{ mbr.nama_lainnya }}
                  </option>
                </select>
              </div>
              <div class="col-lg-12 mb-2">
                <label class="form-label">Nomor HP</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="tambahmember.no_hp"
                  readonly />
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
