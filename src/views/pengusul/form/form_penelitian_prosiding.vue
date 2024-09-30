<script setup>
import { ref, computed } from "vue";

// Membuat variabel reaktif untuk menyimpan status publikasi
const publicationStatus = ref("Submited");

// Computed property untuk menentukan teks label berdasarkan pilihan
const labelBuktiText = computed(() => {
    if (publicationStatus.value === "Sedang-Direview") {
        return "Bukti Sedang Direview";
    } else if (publicationStatus.value === "Accepted") {
        return "Surat Keterangan Accepted dari Editor";
    } else {
        return "Bukti Submit";
    }
});
</script>
<template>
    <div
        class="modal fade"
        id="FormPenelitianProsiding"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Luaran Tambahan Prosiding dalam pertemuan ilmiah
                        Internasional
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-2">
                        <div class="col-xxl-6 col-md-6">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Status Prosiding dalam pertemuan ilmiah
                                    Internasional</label
                                >
                                <select
                                    class="form-select"
                                    id="statusSelect"
                                    v-model="publicationStatus"
                                >
                                    <option value="Submited">Submited</option>
                                    <option value="Sedang-Direview">
                                        Sedang Direview
                                    </option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Published">Published</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-md-6">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Status penulis</label
                                >
                                <select class="form-select">
                                    <option value="First-Author">
                                        First Author
                                    </option>
                                    <option value="Corresponding-Author">
                                        Corresponding Author
                                    </option>
                                    <option value="Co-Author">
                                        First/Corresponding Author
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-md-12">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Nama Conference</label
                                >
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-4 col-sm-6">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Lembaga Penyelenggara</label
                                >
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-4 col-sm-6">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Tempat Penyelenggaraan</label
                                >
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xxl-2 col-md-2 col-sm-6">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Tgl Penyelenggaraan</label
                                >
                                <input type="date" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xxl-2 col-md-2 col-sm-6">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Sampai</label
                                >
                                <input type="date" class="form-control" />
                            </div>
                        </div>
                        <div
                            v-if="publicationStatus === 'Published'"
                            class="col-xxl-12 col-md-12"
                        >
                            <div class="row gy-2">
                                <div class="col-xxl-4 col-md-4 col-sm-6">
                                    <div>
                                        <label
                                            for="basiInput"
                                            class="form-label"
                                            >ISSN/EISSN</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-4 col-sm-6">
                                    <div>
                                        <label
                                            for="basiInput"
                                            class="form-label"
                                            >Lembaga Pengindek</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-4 col-sm-12">
                                    <div>
                                        <label
                                            for="basiInput"
                                            class="form-label"
                                            >URL website conference</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else class="col-xxl-12 col-md-12">
                            <div class="row gy-2">
                                <div class="col-xxl-6 col-md-6 col-sm-12">
                                    <div>
                                        <label
                                            for="basiInput"
                                            class="form-label"
                                            >Lembaga Pengindek</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6 col-sm-12">
                                    <div>
                                        <label
                                            for="basiInput"
                                            class="form-label"
                                            >URL website conference</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-md-12 col-sm-12">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Judul Artikel</label
                                >
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <h5 class="mt-3">Unggah Dokumen</h5>
                        <div v-if="publicationStatus === 'Published'">
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label"
                                        >Artikel yang terbit</label
                                    >
                                    <input
                                        class="form-control"
                                        type="file"
                                        id="formFile"
                                    />
                                    <div
                                        id="passwordHelpBlock"
                                        class="form-text"
                                    >
                                        * Format PDF, DOC, DOCX dengan ukuran 5
                                        Mb
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label"
                                        >Naskah Artikel</label
                                    >
                                    <input
                                        class="form-control"
                                        type="file"
                                        id="formFile"
                                    />
                                    <div
                                        id="passwordHelpBlock"
                                        class="form-text"
                                    >
                                        * Format PDF, DOC, DOCX dengan ukuran 5
                                        Mb
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12 mt-2">
                                <div>
                                    <label for="basiInput" class="form-label">
                                        {{ labelBuktiText }}
                                    </label>
                                    <input
                                        class="form-control"
                                        type="file"
                                        id="formFile"
                                    />
                                    <div
                                        id="passwordHelpBlock"
                                        class="form-text"
                                    >
                                        * Format PDF, DOC, DOCX dengan ukuran 5
                                        Mb
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="ri-save-line align-bottom me-1"></i>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
