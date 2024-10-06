<script setup>
import { ref } from 'vue';
import api from '../api';
import GlobalFooter from '../components/footer.vue';
import { showToast, confirmAkses, showAlert } from '../utils/globalFunctions';

const username = ref('');
const no_hp = ref('');
const akses = ref('');
const btnloading = ref(false);

const verifikasi = async () => {
  try {
    btnloading.value = true; // Indikator loading diaktifkan

    try {
      // Langkah 1: Cek user apakah sudah terdaftar
      const cekuser = await api.get(`/api/cekuser/${username.value}`);

      if (cekuser.data) {
        // Jika user ditemukan, tampilkan alert
        showAlert(
          'Perhatian!',
          `Pengguna ${username.value} ini telah terdaftar`
        );
        btnloading.value = false; // Stop loading
        return; // Tidak lanjut ke pengecekan data mahasiswa
      }
    } catch (error) {
      if (error.response && error.response.status === 404) {
        // Jika user tidak ditemukan, lanjutkan ke pengecekan mahasiswa
        try {
          const response = await api.get(
            `/api/cek/${username.value}/${no_hp.value}`
          );
          if (response.data) {
            // Jika data mahasiswa ditemukan, lakukan registrasi
            const result = await confirmAkses(
              'info',
              'Perhatian!',
              `Username dan Password akan dikirimkan di nomor ${no_hp.value}`
            );
            if (result.isConfirmed) {
              try {
                let formData = new FormData();
                formData.append('username', response.data.data.nim); // Misalnya nim digunakan sebagai username
                formData.append('no_hp', no_hp.value);
                formData.append('akses', akses.value);

                await api.post(`/api/register`, formData); // Lakukan registrasi akun
                // Tampilkan toast sukses
                showToast('Registrasi Berhasil', '#4fbe87');
              } catch (error) {
                console.error('Error delete data:', error);
                // Tampilkan toast error jika gagal menghapus
                showToast('Gagal Registrasi', '#ff6b6b');
              }
            }
          } else {
            // Jika data mahasiswa tidak ditemukan
            showAlert('Perhatian!', 'Data tidak ditemukan', 'warning');
          }
        } catch (error) {
          console.error('Error fetching mahasiswa data:', error);
          showAlert(
            'Perhatian!',
            'Terjadi kesalahan saat pengecekan mahasiswa',
            'warning'
          );
        }
      } else {
        console.error('Error fetching user data:', error);
        showAlert(
          'Perhatian!',
          'Terjadi kesalahan saat pengecekan user',
          'warning'
        );
      }
    }
  } catch (error) {
    console.error('Error during verification process:', error);
    showAlert('Perhatian!', 'Terjadi kesalahan, silakan coba lagi.', 'warning');
  } finally {
    btnloading.value = false; // Indikator loading dinonaktifkan
  }
};
</script>
<template>
  <!-- start hero section -->
  <section class="section job-hero-section bg-light pb-0" id="hero">
    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-6">
          <div>
            <img src="/src/assets/images/iain.png" alt="" class="user-img" />
            <h1 class="display-6 fw-semibold text-capitalize mb-3 lh-base">
              Virtual Assistant Dwingent Recht
            </h1>
            <p class="lead lh-base mb-4"><b>IAIN Sultan Amai Gorontalo</b></p>
            <form @submit.prevent="verifikasi" class="job-panel-filter">
              <div class="row g-md-0 g-2">
                <div class="col-md-4">
                  <div>
                    <input
                      type="text"
                      v-model="username"
                      class="form-control filter-input-box"
                      placeholder="NIM"
                      required />
                  </div>
                </div>
                <!--end col-->
                <div class="col-md-4">
                  <div>
                    <input
                      type="text"
                      v-model="no_hp"
                      class="form-control filter-input-box"
                      placeholder="Nomor WA 0852..."
                      required />
                  </div>
                </div>
                <div class="col-md-4">
                  <div>
                    <select
                      v-model="akses"
                      class="form-control text-muted"
                      data-choices
                      required>
                      <option value="" selected>Pilih Akses --</option>
                      <option value="Mahasiswa">Mahasiswa</option>
                    </select>
                  </div>
                </div>
                <!--end col-->
                <div class="col-md-12">
                  <div class="h-100">
                    <button
                      type="submit"
                      class="btn btn-success submit-btn w-100 h-100">
                      <span v-if="btnloading">
                        <i class="mdi mdi-spin mdi-loading"></i>
                        Loading...
                      </span>
                      <span v-else>
                        <i class="ri-search-2-line align-bottom me-1"></i>
                        Verifikasi Akun Sekarang
                      </span>
                    </button>
                  </div>
                </div>
                <!--end col-->
              </div>
              <!--end row-->
            </form>

            <ul class="treding-keywords list-inline mb-0 mt-3 fs-13">
              <li class="list-inline-item text-danger fw-semibold">
                <i class="mdi mdi-tag-multiple-outline align-middle"></i>
                Sudah Punya Akun?
              </li>
              <li class="list-inline-item">
                <router-link :to="{ name: 'Login' }">
                  Masuk Sekarang
                </router-link>
              </li>
            </ul>
          </div>
        </div>
        <!--end col-->
        <div class="col-lg-6">
          <div class="position-relative home-img text-center mt-5 mt-lg-0">
            <img
              src="/src/assets/images/job-profile2.png"
              alt=""
              class="user-img" />

            <div class="circle-effect">
              <div class="circle"></div>
              <div class="circle2"></div>
              <div class="circle3"></div>
              <div class="circle4"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end hero section -->

  <!-- start cta -->
  <section class="py-5 bg-success position-relative">
    <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
    <div class="container">
      <div class="row align-items-center gy-4">
        <div class="col-sm">
          <div>
            <p class="text-white mb-0 fs-16 text-center">
              Platform ini bertujuan untuk meningkatkan efisiensi dan kemudahan
              bagi mahasiswa dalam mengakses berbagai layanan kampus, sehingga
              interaksi dengan berbagai departemen dapat dilakukan secara cepat
              dan tanpa hambatan.
            </p>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end cta -->

  <!-- start features -->
  <section class="section bg-light">
    <div class="container">
      <div
        class="row align-items-center justify-content-lg-between justify-content-center gy-4">
        <div class="col-lg-5 col-sm-7">
          <div class="about-img-section mb-5 mb-lg-0 text-center">
            <img
              src="/src/assets/images/about.png"
              alt=""
              class="img-fluid mx-auto rounded-3" />
          </div>
        </div>
        <div class="col-lg-6">
          <div>
            <h1 class="mb-3 lh-base">
              Layanan
              <span class="text-success">VADR</span>
            </h1>
            <p class="ff-secondary fs-16 mb-2">
              Virtual Assistant Dwingent Recht adalah sebuah platform yang
              menyediakan berbagai layanan untuk mahasiswa melalui teknologi
              asisten virtual. Platform ini dirancang untuk memudahkan mahasiswa
              dalam mengakses informasi dan layanan yang relevan dengan
              kebutuhan akademis dan administrasi kampus
            </p>
            <div class="vstack gap-2 mb-4 pb-1">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-2">
                  <div class="avatar-xs icon-effect">
                    <div
                      class="avatar-title bg-transparent text-success rounded-circle h2">
                      <i class="ri-check-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0">Layanan e-Services</p>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-2">
                  <div class="avatar-xs icon-effect">
                    <div
                      class="avatar-title bg-transparent text-success rounded-circle h2">
                      <i class="ri-check-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0">Layanan Pengaduan</p>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-2">
                  <div class="avatar-xs icon-effect">
                    <div
                      class="avatar-title bg-transparent text-success rounded-circle h2">
                      <i class="ri-check-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0">Layanan Alumni</p>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-2">
                  <div class="avatar-xs icon-effect">
                    <div
                      class="avatar-title bg-transparent text-success rounded-circle h2">
                      <i class="ri-check-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0">Layanan Mahasiswa Baru</p>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-2">
                  <div class="avatar-xs icon-effect">
                    <div
                      class="avatar-title bg-transparent text-success rounded-circle h2">
                      <i class="ri-check-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0">Layanan Akademik</p>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-2">
                  <div class="avatar-xs icon-effect">
                    <div
                      class="avatar-title bg-transparent text-success rounded-circle h2">
                      <i class="ri-check-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0">Call Center</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end features -->

  <!-- Start footer -->
  <GlobalFooter />
  <!-- end footer -->

  <!-- Include the Modal Component -->
</template>
