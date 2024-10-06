<script setup></script>

<template>
  <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="text-center mb-5">
              <h2 class="mb-3 fw-bold lh-base">Layanan VADR</h2>
              <p class="text-muted">
                Platform ini bertujuan untuk meningkatkan efisiensi dan
                kemudahan bagi dosen dalam mengakses berbagai layanan kampus,
                sehingga interaksi dengan berbagai departemen dapat dilakukan
                secara cepat dan tanpa hambatan.
              </p>
            </div>
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="card shadow-none">
              <div class="card-body">
                <img
                  src="/src/assets/images/smart-contract.png"
                  alt=""
                  class="avatar-sm" />
                <h5 class="mt-4">Kepegawaian</h5>
                <p class="text-muted fs-14">
                  Pengurusan data kepegawaian, absensi, pengajuan cuti, serta
                  kebutuhan administratif lainnya secara digital.
                </p>
                <a href="#!" class="link-primary fs-14"
                  >Masuk <i class="ri-arrow-right-line align-bottom"></i
                ></a>
              </div>
            </div>
          </div>
          <!--end col-->
          <div class="col-lg-4">
            <div class="card shadow-none">
              <div class="card-body">
                <img
                  src="/src/assets/images/businessman.png"
                  alt=""
                  class="avatar-sm" />
                <h5 class="mt-4">Pengaduan</h5>
                <p class="text-muted fs-14">
                  Dosen dapat menyampaikan pengaduan terkait masalah akademik,
                  atau keluhan lainnya melalui halaman ini.
                </p>
                <router-link
                  class="link-primary fs-14"
                  :to="{ name: 'DosenDashboardPengaduan' }">
                  Masuk <i class="ri-arrow-right-line align-bottom"></i>
                </router-link>
              </div>
            </div>
          </div>
          <!--end col-->
          <div class="col-lg-4">
            <div class="card shadow-none">
              <div class="card-body">
                <img
                  src="/src/assets/images/money.png"
                  alt=""
                  class="avatar-sm" />
                <h5 class="mt-4">Keuangan</h5>
                <p class="text-muted fs-14">
                  Monitoring, Informasi keuangan terkait pembayaran, beasiswa,
                  serta biaya kuliah
                </p>
                <a href="#!" class="link-primary fs-14"
                  >Masuk <i class="ri-arrow-right-line align-bottom"></i
                ></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card shadow-none">
              <div class="card-body">
                <img
                  src="/src/assets/images/education.png"
                  alt=""
                  class="avatar-sm" />
                <h5 class="mt-4">Akademik</h5>
                <p class="text-muted fs-14">
                  Dosen dapat mengakses informasi mengenai jadwal kuliah, nilai,
                  absensi, dan kegiatan akademik lainnya.
                </p>
                <a
                  href="https://siak.iaingorontalo.ac.id"
                  class="link-primary fs-14"
                  target="_blank"
                  >Masuk <i class="ri-arrow-right-line align-bottom"></i
                ></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card shadow-none">
              <div class="card-body">
                <img
                  src="/src/assets/images/customer-service.png"
                  alt=""
                  class="avatar-sm" />
                <h5 class="mt-4">Call Center</h5>
                <p class="text-muted fs-14">
                  Layanan bantuan lainnya secara langsung, memberikan pengalaman
                  yang lebih interaktif dan responsif.
                </p>
                <a href="#!" class="link-primary fs-14"
                  >Masuk <i class="ri-arrow-right-line align-bottom"></i
                ></a>
              </div>
            </div>
          </div>
          <!--end col-->
        </div>
        <!--end row-->
      </div>
      <!-- end container -->
    </div>
  </div>
  <!-- end features -->
</template>
