<script setup>
import { thnsekarang } from "../utils/globalFunctions";
</script>
<template>
    <div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        {{ thnsekarang() }} LP2M - Paluwala
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by UPA TIK UNG
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
