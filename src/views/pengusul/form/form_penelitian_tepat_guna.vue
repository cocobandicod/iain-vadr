<script setup></script>
<template>
    <div
        class="modal fade"
        id="FormPenelitianTepatGuna"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Luaran Tambahan Teknologi Tepat Guna
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
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Status Teknologi Tepat Guna</label
                                >
                                <select class="form-select">
                                    <option value="Produk">Produk</option>
                                    <option value="Penerapan">Penerapan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-md-12">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Nama Teknologi Tepat Guna</label
                                >
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xxl-12 col-md-12">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Pemegang Teknologi Tepat Guna</label
                                >
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <h5 class="mt-3">
                            Periode Uji Coba Teknologi Tepat Guna
                        </h5>
                        <div class="col-xxl-3 col-md-3 col-sm-6">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Tanggal Awal</label
                                >
                                <input type="date" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3 col-sm-6">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Tanggal Akhir</label
                                >
                                <input type="date" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xxl-6 col-md-6 col-sm-12">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Link video dokumentasi pengujian Teknologi
                                    Tepat Guna</label
                                >
                                <input type="text" class="form-control" />
                            </div>
                        </div>

                        <h5 class="mt-3">Unggah Dokumen</h5>
                        <div class="col-xxl-12 col-md-12">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Deskripsi dan spesifikasi Teknologi Tepat
                                    Guna</label
                                >
                                <input
                                    class="form-control"
                                    type="file"
                                    id="formFile"
                                />
                                <div id="passwordHelpBlock" class="form-text">
                                    * Format PDF, DOC, DOCX dengan ukuran 5 Mb
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-md-12">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Hasil uji Teknologi Tepat Guna
                                    terakhir</label
                                >
                                <input
                                    class="form-control"
                                    type="file"
                                    id="formFile"
                                />
                                <div id="passwordHelpBlock" class="form-text">
                                    * Format PDF, DOC, DOCX dengan ukuran 5 Mb
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-md-12">
                            <div>
                                <label for="basiInput" class="form-label"
                                    >Dokumentasi (foto) pengujian Teknologi
                                    Tepat Guna</label
                                >
                                <input
                                    class="form-control"
                                    type="file"
                                    id="formFile"
                                />
                                <div id="passwordHelpBlock" class="form-text">
                                    * Format PDF, DOC, DOCX dengan ukuran 5 Mb
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
