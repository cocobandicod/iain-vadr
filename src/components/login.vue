<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '../api'; // Sesuaikan dengan path api Anda
import { thnsekarang } from '../utils/globalFunctions';

const username = ref('');
const password = ref('');
const errorMessage = ref('');
const isLoading = ref(false);
const router = useRouter();

const login = async () => {
  isLoading.value = true; // Set isLoading ke true saat proses login dimulai
  errorMessage.value = ''; // Kosongkan pesan error sebelumnya

  try {
    const response = await api.post('/api/login', {
      username: username.value,
      password: password.value,
    });

    const { token, id_user, hak_akses, nama_pengguna } = response.data;

    // Simpan token, hak_akses, dan nama_pengguna di localStorage
    localStorage.setItem('token', token);
    localStorage.setItem('id_user', id_user);
    localStorage.setItem('hak_akses', hak_akses);
    localStorage.setItem('nama_pengguna', nama_pengguna);

    // Alihkan pengguna berdasarkan hak_akses mereka
    if (hak_akses === 'Mahasiswa') {
      router.push('/mahasiswa/dashboard').then(() => {
        window.location.reload();
      });
    } else if (hak_akses === 'Dosen') {
      router.push('/dosen/dashboard').then(() => {
        window.location.reload();
      });
    } else if (hak_akses === 'Pegawai') {
      router.push('/pegawai/dashboard').then(() => {
        window.location.reload();
      });
    } else if (hak_akses === 'Operator') {
      router.push('/operator/dashboard').then(() => {
        window.location.reload();
      });
    } else {
      errorMessage.value = 'Login Gagal! username dan password salah';
    }
  } catch (error) {
    errorMessage.value = 'Login Gagal! username dan password salah';
  } finally {
    isLoading.value = false; // Set isLoading ke false setelah proses selesai
  }
};
</script>

<template>
  <div
    class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card overflow-hidden">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="p-lg-5 p-4 auth-one-bg h-100">
                    <div class=""></div>
                    <div class="position-relative h-100 d-flex flex-column">
                      <div class="mb-4">
                        <a href="index-2.html" class="d-block">
                          <img
                            src="/src/assets/images/logo-light.png"
                            alt=""
                            height="18" />
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end col -->

                <div class="col-lg-6">
                  <div class="p-lg-5 p-4">
                    <div>
                      <h5 class="text-primary">Selamat Datang!</h5>
                      <p class="text-muted">
                        Silahkan Login untuk mengakses layanan ini
                      </p>
                    </div>

                    <div class="mt-4">
                      <form @submit.prevent="login">
                        <div
                          class="alert alert-danger text-center"
                          role="alert"
                          v-if="errorMessage">
                          {{ errorMessage }}
                        </div>
                        <div class="mb-3">
                          <label for="username" class="form-label"
                            >Username</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            v-model="username"
                            placeholder="Masukan NIDN/NIM/Username"
                            required />
                        </div>

                        <div class="mb-3">
                          <div class="float-end">
                            <a href="#" class="text-muted">Lupa Password?</a>
                          </div>
                          <label class="form-label" for="password-input"
                            >Password</label
                          >
                          <div
                            class="position-relative auth-pass-inputgroup mb-3">
                            <input
                              type="password"
                              class="form-control pe-5 password-input"
                              placeholder="Masukan Password"
                              v-model="password"
                              required />
                          </div>
                        </div>

                        <div class="mt-4">
                          <button
                            :disabled="isLoading"
                            class="btn btn-success w-100"
                            type="submit">
                            <span v-if="isLoading">
                              <i class="mdi mdi-spin mdi-loading"></i>
                              Loading...
                            </span>
                            <span v-else>Login</span>
                          </button>
                        </div>
                      </form>
                    </div>

                    <div class="mt-2 text-center">
                      <p class="mb-0">
                        Belum Punya Akun ?
                        <router-link
                          type="button"
                          :to="{ name: 'home' }"
                          class="fw-semibold text-primary">
                          <i class="ri-user-3-line align-bottom me-1"></i>
                          Verifikasi Akun
                        </router-link>
                      </p>
                    </div>
                  </div>
                </div>
                <!-- end col -->
              </div>
              <!-- end row -->
            </div>
            <!-- end card -->
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center">
              <p class="mb-0">
                &copy; {{ thnsekarang() }} IAIN Sultan Amai Gorontalo
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- end Footer -->
  </div>
  <!-- end auth-page-wrapper -->
</template>
