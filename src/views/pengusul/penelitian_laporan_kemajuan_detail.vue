<script setup>
import FormPenelitianPublikasiIlmiah from "./form/form_penelitian_publikasi_ilmiah.vue";
import FormPenelitianPurwarupa from "./form/form_penelitian_purwarupa.vue";
import FormPenelitianMetode from "./form/form_penelitian_metode.vue";
import FormPenelitianTepatGuna from "./form/form_penelitian_tepat_guna.vue";
import FormPenelitianProsiding from "./form/form_penelitian_prosiding.vue";
</script>
<template>
    <div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between"
                            >
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">Laporan Kemajuan</h4>
                                    <p class="text-muted mb-0">
                                        Laporan Kemajuan Penelitian
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Success Alert -->
                                    <div
                                        class="alert alert-success alert-dismissible alert-additional fade show"
                                        role="alert"
                                    >
                                        <div class="alert-body">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <i
                                                        class="ri-notification-off-line fs-16 align-middle"
                                                    ></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="alert-heading">
                                                        Usulan Penelitian
                                                    </h5>
                                                    <p class="mb-0 fs-16">
                                                        Multi-Objective
                                                        Coevolutionary
                                                        Optimization Method For
                                                        Mutation Testing
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert-content">
                                            <p class="mb-0">
                                                Penelitian Disertasi Doctor
                                                Tahun ke 1 dari 1
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h5>Ringkasan</h5>
                                        <p>
                                            Tuliskan secara ringkas latar
                                            belakang penelitian, tujuan dan
                                            tahapaan metode penelitian, luaran
                                            yang ditargetkan, uraian TKT
                                            penelitian dan hasil penelitian yang
                                            diperoleh sesuai dengan tahun
                                            pelaksanaan penelitian.
                                        </p>
                                        <div>
                                            <textarea
                                                name=""
                                                id=""
                                                class="form-control"
                                                placeholder="Ringkasan Penelitian"
                                            ></textarea>
                                        </div>
                                        <h5 class="mt-3">Keyword</h5>
                                        <p>
                                            Maksimal 5 kata kunci. Gunakan tanda
                                            baca titik koma (;) sebagai pemisah
                                        </p>
                                        <div>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Keyword1; Keyword2; Keyword3;"
                                            />
                                        </div>
                                        <h5 class="mt-3">Subtansi Laporan</h5>
                                        <p>
                                            Unggah dokumen substansi laporan
                                            kemajuan dalam format PDF sesuai
                                            dengan template yang disediakan, dan
                                            klik simpan perubahan
                                        </p>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <input
                                                        class="form-control"
                                                        type="file"
                                                        id="formFile"
                                                    />
                                                    <div
                                                        id="passwordHelpBlock"
                                                        class="form-text"
                                                    >
                                                        * Format PDF dengan
                                                        ukuran 5 Mb
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <button class="btn btn-success">
                                                    <i
                                                        class="ri-file-download-line me-1"
                                                    ></i>
                                                    Unduh Template
                                                </button>
                                            </div>
                                        </div>
                                        <h5 class="mt-3">
                                            Realisasi Keterlibatan/Kontribusi
                                            Mitra
                                        </h5>
                                        <p>
                                            Unggah dokumen substansi laporan
                                            kemajuan dalam format PDF sesuai
                                            dengan template yang disediakan, dan
                                            klik simpan perubahan
                                        </p>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <input
                                                        class="form-control"
                                                        type="file"
                                                        id="formFile"
                                                    />
                                                    <div
                                                        id="passwordHelpBlock"
                                                        class="form-text"
                                                    >
                                                        * Format PDF dengan
                                                        ukuran 5 Mb
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="float-end mt-4">
                                            <button
                                                type="submit"
                                                class="btn btn-success"
                                            >
                                                <i
                                                    class="ri-save-line align-bottom me-1"
                                                ></i>
                                                Simpan Perubahan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div
                                    class="card-header align-items-center d-flex"
                                >
                                    <h4 class="card-title mb-0 flex-grow-1">
                                        Luaran Wajib
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table
                                        class="table table-striped table-bordered"
                                    >
                                        <thead class="table-light">
                                            <tr>
                                                <th
                                                    class="text-center"
                                                    style="width: 3%"
                                                >
                                                    No
                                                </th>
                                                <th>Judul</th>
                                                <th
                                                    class="text-center"
                                                    style="width: 3%"
                                                >
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>
                                                    Publikasi Ilmiah Jurnal
                                                    Internasional - publikasi
                                                    jurnal
                                                </td>
                                                <td
                                                    class="text-center"
                                                    style="width: 3%"
                                                >
                                                    <a
                                                        class="cursor-pointer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#FormPenelitianPublikasiIlmiah"
                                                    >
                                                        <i
                                                            class="ri-pencil-fill align-middle fs-18"
                                                        ></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div
                                    class="card-header align-items-center d-flex"
                                >
                                    <h4 class="card-title mb-0 flex-grow-1">
                                        Luaran Tambahan
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table
                                        class="table table-striped table-bordered"
                                    >
                                        <thead class="table-light">
                                            <tr>
                                                <th
                                                    class="text-center"
                                                    style="width: 3%"
                                                >
                                                    No
                                                </th>
                                                <th>Judul</th>
                                                <th
                                                    class="text-center"
                                                    style="width: 3%"
                                                >
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>
                                                    Purwarupa/Prototipe -
                                                    purwarupa prototipe
                                                </td>
                                                <td
                                                    class="text-center"
                                                    style="width: 3%"
                                                >
                                                    <a
                                                        class="cursor-pointer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#FormPenelitianPurwarupa"
                                                    >
                                                        <i
                                                            class="ri-pencil-fill align-middle fs-18"
                                                        ></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>Metode - metode</td>
                                                <td
                                                    class="text-center"
                                                    style="width: 3%"
                                                >
                                                    <a
                                                        class="cursor-pointer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#FormPenelitianMetode"
                                                    >
                                                        <i
                                                            class="ri-pencil-fill align-middle fs-18"
                                                        ></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>
                                                    Teknologi Tepat Guna - ttg
                                                </td>
                                                <td
                                                    class="text-center"
                                                    style="width: 3%"
                                                >
                                                    <a
                                                        class="cursor-pointer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#FormPenelitianTepatGuna"
                                                    >
                                                        <i
                                                            class="ri-pencil-fill align-middle fs-18"
                                                        ></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>
                                                    Prosiding dalam pertemuan
                                                    ilmiah Internasional -
                                                    konferensi
                                                </td>
                                                <td
                                                    class="text-center"
                                                    style="width: 3%"
                                                >
                                                    <a
                                                        class="cursor-pointer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#FormPenelitianProsiding"
                                                    >
                                                        <i
                                                            class="ri-pencil-fill align-middle fs-18"
                                                        ></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3 mb-4">
                                <button
                                    type="button"
                                    class="btn btn-danger btn-label previestab"
                                    data-previous="steparrow-gen-info-tab"
                                >
                                    <i
                                        class="ri-arrow-left-line label-icon align-middle fs-16 me-2"
                                    ></i>
                                    Tutup Form
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                    data-nexttab="pills-experience-tab"
                                >
                                    <i
                                        class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"
                                    ></i
                                    >Selanjutnya
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <FormPenelitianPublikasiIlmiah />
    <FormPenelitianPurwarupa />
    <FormPenelitianMetode />
    <FormPenelitianTepatGuna />
    <FormPenelitianProsiding />
</template>
<style lang=""></style>
