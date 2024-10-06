<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import GlobalNavbar from './components/navbar.vue';
import MahasiswaNavbar from './components/mahasiswa_navbar.vue';
import DosenNavbar from './components/dosen_navbar.vue';
import PegawaiNavbar from './components/pegawai_navbar.vue';
import OperatorNavbar from './components/operator_navbar.vue';
import OperatorFooter from './components/operator_footer.vue';

const route = useRoute();
const isLoginPage = computed(() => route.path === '/login');
const isRegisterPage = computed(() => route.path === '/register');
const isOperatorPage = computed(() => route.path.startsWith('/operator'));
const isMahasiswaPage = computed(() => route.path.startsWith('/mahasiswa'));
const isPegawaiPage = computed(() => route.path.startsWith('/pegawai'));
const isDosenPage = computed(() => route.path.startsWith('/dosen'));
const isNotFoundPage = computed(() => route.name === 'NotFound');
</script>

<template>
  <div>
    <!-- Tampilkan navbar jika bukan halaman login, operator, atau not found -->
    <div
      v-if="
        !isLoginPage &&
        !isRegisterPage &&
        !isMahasiswaPage &&
        !isDosenPage &&
        !isOperatorPage &&
        !isPegawaiPage &&
        !isNotFoundPage
      ">
      <GlobalNavbar />
    </div>

    <!-- Tampilkan layout Mahasiswa jika halaman Mahasiswa -->
    <div v-else-if="isMahasiswaPage && !isNotFoundPage">
      <MahasiswaNavbar />
    </div>

    <!-- Tampilkan layout Dosen jika halaman Dosen -->
    <div v-else-if="isDosenPage && !isNotFoundPage">
      <DosenNavbar />
    </div>

    <!-- Tampilkan layout Pegawai jika halaman Pegawai -->
    <div v-else-if="isPegawaiPage && !isNotFoundPage">
      <PegawaiNavbar />
    </div>

    <!-- Tampilkan layout Operator jika halaman Operator -->
    <div v-else-if="isOperatorPage && !isNotFoundPage">
      <OperatorNavbar />
    </div>

    <!-- Render router view -->
    <router-view></router-view>

    <!-- Tampilkan layout operator jika halaman operator -->
    <div
      v-if="
        (isOperatorPage || isMahasiswaPage || isDosenPage || isPegawaiPage) &&
        !isNotFoundPage
      ">
      <OperatorFooter />
    </div>
  </div>
</template>
