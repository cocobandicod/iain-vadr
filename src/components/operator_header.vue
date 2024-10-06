<template>
  <div>
    <header id="page-topbar">
      <div class="layout-width">
        <div class="navbar-header">
          <div class="d-flex">
            <div class="horizontal-logo">
              <a href="#" class="logo logo-dark">
                <span class="logo-sm">
                  <img
                    src="/src/assets/images/logo-dark.png"
                    alt=""
                    height="25" />
                </span>
                <span class="logo-lg">
                  <img
                    src="/src/assets/images/logo-dark.png"
                    alt=""
                    height="25" />
                </span>
              </a>
            </div>

            <button
              type="button"
              class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
              id="topnav-hamburger-icon">
              <span class="hamburger-icon">
                <span></span>
                <span></span>
                <span></span>
              </span>
            </button>
          </div>

          <div class="d-flex align-items-center">
            <div class="dropdown ms-sm-3 header-item">
              <button
                type="button"
                class="btn"
                id="page-header-user-dropdown"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <span class="d-flex align-items-center">
                  <img
                    class="rounded-circle header-profile-user"
                    src="/src/assets/images/user.png"
                    alt="Header Avatar" />
                  <span class="text-start ms-xl-2">
                    <span
                      class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                      {{ namaPengguna }}
                    </span>
                    <span
                      class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">
                      {{ hakAkses }}
                    </span>
                  </span>
                </span>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <h6 class="dropdown-header">Welcome</h6>
                <a class="dropdown-item" href="#">
                  <i
                    class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                  <span class="align-middle">Profile</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i
                    class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
                  <span class="align-middle">Settings</span>
                </a>
                <button class="dropdown-item" @click="logout">
                  <i
                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                  <span class="align-middle">Logout</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
  </div>
</template>
<script>
import { ref, onMounted } from 'vue';
import api from '../api'; // Sesuaikan dengan path api Anda

const token = localStorage.getItem('token');

export default {
  setup() {
    const namaPengguna = ref('');
    const hakAkses = ref('');

    onMounted(() => {
      // Mengambil nilai dari localStorage
      namaPengguna.value = localStorage.getItem('nama_pengguna') || 'Guest';
      hakAkses.value = localStorage.getItem('hak_akses') || 'Unknown';
    });

    return {
      namaPengguna,
      hakAkses,
    };
  },
  methods: {
    async logout() {
      try {
        if (token) {
          // Token tersedia, kirim permintaan
          await api.post('/api/logout', null, {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
        } else {
          console.error('Token tidak tersedia');
        }

        // Menghapus data dari localStorage
        localStorage.clear();

        // Redirect ke halaman login
        //this.$router.push("/login");
        this.$router.push('/login').then(() => {
          window.location.reload();
        });
      } catch (error) {
        console.error('Logout gagal:', error);
      }
    },
  },
};
</script>
