<script setup>
import { thnsekarang } from '../utils/globalFunctions';
</script>
<template>
  <div>
    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">{{ thnsekarang() }} VADR - IAIN Gorontalo</div>
          <div class="col-sm-6">
            <div class="text-sm-end d-none d-sm-block">
              Design & Develop by Bengkel IT
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>
