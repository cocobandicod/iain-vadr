<script setup>
import { ref, onMounted } from 'vue';
import api from '../api';
import { thnsekarang } from '../utils/globalFunctions';
const link = ref([]);
const fetchDataLink = async () => {
  try {
    const response = await api.get('/api/link');
    link.value = response.data.data.data;
  } catch (error) {
    console.error('Error fetching link data:', error);
  }
};

onMounted(() => {
  fetchDataLink();
});
</script>
<template>
  <!-- Start footer -->
  <footer class="custom-footer bg-dark py-5 position-relative">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 mt-4">
          <div>
            <div>
              <img
                src="/src/assets/images/logo-light.png"
                alt="logo light"
                height="25" />
            </div>
            <div class="mt-2 fs-13">
              <p>
                Virtual Assistant Dwingent Recht<br />
                IAIN Sultan Amai Gorontalo
              </p>
              <p>
                <b>Kampus 1</b><br />
                Jl. Gelatik, Heledulaa, Kec. Kota Tim., Kota Gorontalo,
                Gorontalo 96135<br />
                <b>Kampus 2</b><br />
                Jl. Sultan Amai Kel. Pone Kec. Limboto Kabupaten Gorontalo
              </p>
              <ul class="list-inline mb-0 footer-social-link">
                <li class="list-inline-item">
                  <a
                    href="https://www.facebook.com/pustipad.iaingorontalo"
                    class="avatar-xs d-block">
                    <div class="avatar-title rounded-circle">
                      <i class="ri-facebook-fill"></i>
                    </div>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a
                    href="https://www.instagram.com/iaingorontalo/"
                    class="avatar-xs d-block">
                    <div class="avatar-title rounded-circle">
                      <i class="ri-instagram-fill"></i>
                    </div>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a
                    href="https://www.youtube.com/@IAINGorontaloOfficial"
                    class="avatar-xs d-block">
                    <div class="avatar-title rounded-circle">
                      <i class="ri-youtube-fill"></i>
                    </div>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a
                    href="mailto:info@iaingorontalo.ac.id"
                    class="avatar-xs d-block">
                    <div class="avatar-title rounded-circle">
                      <i class="ri-mail-fill"></i>
                    </div>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a
                    href="https://maps.app.goo.gl/HebviZhubrMzwMog7"
                    class="avatar-xs d-block">
                    <div class="avatar-title rounded-circle">
                      <i class="ri-map-pin-fill"></i>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-7 ms-lg-auto">
          <div class="row">
            <div class="col-sm-4 mt-4">
              <h5 class="text-white mb-0">Tautan</h5>
              <div class="text-muted mt-3">
                <ul class="list-unstyled ff-secondary footer-list">
                  <li v-for="(link, index) in link" :key="index">
                    <a :href="link.link" target="_blank">{{ link.judul }}</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-center text-sm-start align-items-center mt-5">
        <div class="col-sm-12">
          <div>
            <p class="copy-rights mb-0">{{ thnsekarang() }} VADR-IAIN</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- end footer -->
</template>
