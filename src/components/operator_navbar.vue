<script setup>
import GlobalHeader from '../components/operator_header.vue';
</script>
<template>
  <GlobalHeader />
  <div>
    <div class="app-menu navbar-menu">
      <!-- LOGO -->

      <div id="scrollbar">
        <div class="container-fluid">
          <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title">
              <span data-key="t-menu">Menu</span>
            </li>
            <!-- end Dashboard Menu -->
            <li class="nav-item">
              <router-link
                :to="{
                  name: 'OperatorDashboard',
                }"
                class="nav-link menu-link">
                <i class="ri-home-smile-line"></i>
                Dashboards
              </router-link>
            </li>
            <li class="nav-item">
              <a
                class="nav-link menu-link collapsed"
                href="#sidebarApps"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="false"
                aria-controls="sidebarApps">
                <i class="ri-hard-drive-2-line"></i>
                <span data-key="t-apps">Master</span>
              </a>
              <div class="menu-dropdown collapse" id="sidebarApps" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <router-link
                      :to="{
                        name: 'OperatorMasterDosen',
                      }"
                      class="nav-link">
                      Dosen
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link
                      :to="{
                        name: 'OperatorMasterPegawai',
                      }"
                      class="nav-link">
                      Pegawai
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link
                      :to="{
                        name: 'OperatorMasterMahasiswa',
                      }"
                      class="nav-link">
                      Mahasiswa
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link
                      :to="{
                        name: 'OperatorMasterLainnya',
                      }"
                      class="nav-link">
                      Lainnya
                    </router-link>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a
                class="nav-link menu-link collapsed"
                href="#sidebarApps"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="false"
                aria-controls="sidebarApps">
                <i class="ri-customer-service-2-line"></i>
                <span data-key="t-apps">Layanan</span>
              </a>
              <div class="menu-dropdown collapse" id="sidebarApps" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <router-link
                      :to="{
                        name: 'OperatorDashboard',
                      }"
                      class="nav-link">
                      e-Services
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link
                      :to="{
                        name: 'OperatorDashboard',
                      }"
                      class="nav-link">
                      Pengaduan
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link
                      :to="{
                        name: 'OperatorDashboard',
                      }"
                      class="nav-link">
                      Alumni
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link
                      :to="{
                        name: 'OperatorDashboard',
                      }"
                      class="nav-link">
                      Mahasiswa Baru
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link
                      :to="{
                        name: 'OperatorDashboard',
                      }"
                      class="nav-link">
                      Akademik
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link
                      :to="{
                        name: 'OperatorDashboard',
                      }"
                      class="nav-link">
                      Call Center
                    </router-link>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a
                class="nav-link menu-link collapsed"
                href="#sidebarApps"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="false"
                aria-controls="sidebarApps">
                <i class="ri-mail-send-line"></i>
                <span data-key="t-apps">Kirim Pesan</span>
              </a>
              <div class="menu-dropdown collapse" id="sidebarApps" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a
                      href="#sidebarProfile"
                      class="nav-link"
                      data-bs-toggle="collapse"
                      role="button"
                      aria-expanded="false"
                      aria-controls="sidebarProfile"
                      data-key="t-profile">
                      Mahasiswa
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProfile">
                      <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                          <router-link
                            :to="{
                              name: 'OperatorMahasiswaPesan',
                            }"
                            class="nav-link">
                            Pesan Baru
                          </router-link>
                        </li>
                        <li class="nav-item">
                          <router-link
                            :to="{
                              name: 'OperatorMahasiswaGroup',
                            }"
                            class="nav-link">
                            Kirim Pesan Group
                          </router-link>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a
                      href="#sidebarProfile"
                      class="nav-link"
                      data-bs-toggle="collapse"
                      role="button"
                      aria-expanded="false"
                      aria-controls="sidebarProfile"
                      data-key="t-profile">
                      Orang Tua Mahasiswa
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProfile">
                      <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                          <router-link
                            :to="{
                              name: 'OperatorOrangtuaPesan',
                            }"
                            class="nav-link">
                            Pesan Baru
                          </router-link>
                        </li>
                        <li class="nav-item">
                          <router-link
                            :to="{
                              name: 'OperatorOrangtuaGroup',
                            }"
                            class="nav-link">
                            Kirim Pesan Group
                          </router-link>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a
                      href="#sidebarProfile"
                      class="nav-link"
                      data-bs-toggle="collapse"
                      role="button"
                      aria-expanded="false"
                      aria-controls="sidebarProfile"
                      data-key="t-profile">
                      Dosen
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProfile">
                      <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                          <router-link
                            :to="{
                              name: 'OperatorDosenPesan',
                            }"
                            class="nav-link">
                            Pesan Baru
                          </router-link>
                        </li>
                        <li class="nav-item">
                          <router-link
                            :to="{
                              name: 'OperatorDosenGroup',
                            }"
                            class="nav-link">
                            Kirim Pesan Group
                          </router-link>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a
                      href="#sidebarProfile"
                      class="nav-link"
                      data-bs-toggle="collapse"
                      role="button"
                      aria-expanded="false"
                      aria-controls="sidebarProfile"
                      data-key="t-profile">
                      Pegawai
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProfile">
                      <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                          <router-link
                            :to="{
                              name: 'OperatorPegawaiPesan',
                            }"
                            class="nav-link">
                            Pesan Baru
                          </router-link>
                        </li>
                        <li class="nav-item">
                          <router-link
                            :to="{
                              name: 'OperatorPegawaiGroup',
                            }"
                            class="nav-link">
                            Kirim Pesan Group
                          </router-link>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a
                      href="#sidebarProfile"
                      class="nav-link"
                      data-bs-toggle="collapse"
                      role="button"
                      aria-expanded="false"
                      aria-controls="sidebarProfile"
                      data-key="t-profile">
                      Lainnya
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProfile">
                      <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                          <router-link
                            :to="{
                              name: 'OperatorLainnyaPesan',
                            }"
                            class="nav-link">
                            Pesan Baru
                          </router-link>
                        </li>
                        <li class="nav-item">
                          <router-link
                            :to="{
                              name: 'OperatorLainnyaGroup',
                            }"
                            class="nav-link">
                            Kirim Pesan Group
                          </router-link>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <router-link
                :to="{
                  name: 'OperatorReportPesan',
                }"
                class="nav-link menu-link">
                <i class="ri-mail-check-line"></i>
                Report Pesan
              </router-link>
            </li>
          </ul>
        </div>
        <!-- Sidebar -->
      </div>
    </div>
  </div>
</template>
