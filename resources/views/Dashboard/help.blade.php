@extends('Template.layouts')

@section('main')
    <h2 class="fw-bold">Frequently Asked Questions</h2>
    <nav>
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Bantuan</li>
        </ol>
    </nav>

    <section class="section faq">
        <div class="row">
            <div class="col-lg-6">

                <div class="card basic">
                    <div class="card-body">
                        <h5 class="card-title">Pertanyaan Umum</h5>

                        <div>
                            <h6>1. Bagaimana cara mengatur profil sendiri ?</h6>
                            <p>Tekan ikon profil di pojok kanan atas, lalu pilih <strong>atur profil</strong>. Di menu
                                tersebut anda dapat mengganti beberapa data anda. Termasuk mengganti kata sandi.
                            </p>
                        </div>

                        <div class="pt-2">
                            <h6>2. Tabel tidak tertampil dengan maksimum</h6>
                            <p>
                                <code>Untuk pengguna PC/Komputer</code> :
                                Bila anda menggunakan perangkat PC :geser hingga ke halaman paling bawah. Di situ anda akan
                                menemukan scrollbar horizontal untuk tabel. Kini kolom lain di sisi kanan tabel dapat
                                terlihat.
                                <br>
                                <code>Untuk pengguna mobile</code> : Swipe ke arah kiri, untuk melihat konten tabel lebih
                                lengkap. Disarankan menggunakan perangkat android.

                            </p>
                        </div>

                        <div class="pt-2">
                            <h6>3. Informasi yang saya cari tidak ada.</h6>
                            <p>Pada kasus anda tidak dapat menemukan informasi yang dicari pada aplikasi ini, silakan
                                menghubungi Pengelola Laboratorium. Kontak Pengelola dapat ditemukan pada halaman <a
                                    href="{{ route('dashboard.contact') }}"><strong>Kontak</strong></a>
                            </p>
                        </div>

                    </div>
                </div>

                <!-- F.A.Q Group 1 -->
                <div class="card my-1">
                    <div class="card-body">
                        <h5 class="card-title">Pertanyaan Terkait dengan Akun</h5>

                        <div class="accordion accordion-flush" id="faq-group-1">

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsOne-1" type="button"
                                        data-bs-toggle="collapse">
                                        Beberapa data akun tidak dapat diubah.
                                    </button>
                                </h2>
                                <div id="faqsOne-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                                    <div class="accordion-body">
                                        <p>
                                            Terdapat beberapa data yang tidak dapat diubah sendiri oleh pemilik akun. Hal
                                            ini
                                            terkait dengan keamanan aset Laboratorium. <br>
                                            Jika terdapat kesalahan pada data akun
                                            anda, silakan langsung menghubungi Pengelola laboratorium.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsOne-2" type="button"
                                        data-bs-toggle="collapse">
                                        Login menggunakan sosial media?
                                    </button>
                                </h2>
                                <div id="faqsOne-2" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                                    <div class="accordion-body">
                                        <p>
                                            Jika anda sudah memiliki akun dengan cara mendaftar melalui proses registrasi.
                                            Anda
                                            dapat langsung login menggunakan sosial media yang terintegrasi dengan
                                            <strong>email
                                                yang sama</strong>. Data akun yg sudah didaftarkan tidak akan
                                            berubah/ter-reset.
                                            Jika akun sosial media yang digunakan memiliki email yang berbeda, maka sistem
                                            akan
                                            membuatkan akun baru.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsOne-3" type="button"
                                        data-bs-toggle="collapse">
                                        Bagaimana cara mengganti kata sandi akun yang login menggunakan sosial media?
                                    </button>
                                </h2>
                                <div id="faqsOne-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                                    <div class="accordion-body">
                                        <p>
                                            Jika anda mendaftar langsung menggunakan sosial media dan hendak mengganti kata
                                            sandi. Silakan ikuti panduan yang terdapat di menu <strong>ubah kata
                                                sandi</strong>
                                            di halaman <a
                                                href="{{ route('dashboard.profile') }}"><strong>profil</strong></a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsOne-4" type="button"
                                        data-bs-toggle="collapse">
                                        Lupa kata sandi tapi masih login.
                                    </button>
                                </h2>
                                <div id="faqsOne-4" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                                    <div class="accordion-body">
                                        <p>
                                            Jika anda masih login dan dapat mengakses pagu utama & fitur-fitur di dalamnya,
                                            silakan logout terlebih dahulu. Gunakan fitur lupa kata sandi, di halaman login.
                                            Masukkan email yang terdaftar. <strong>Kata sandi baru</strong> akan dikirimkan
                                            melalui Email.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsOne-5" type="button"
                                        data-bs-toggle="collapse">
                                        Apakah data personal aman?
                                    </button>
                                </h2>
                                <div id="faqsOne-5" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                                    <div class="accordion-body">
                                        <p>
                                            Hanya admin dan kepala laboratorium yang dapat melihat data personal Anda,
                                            seperti
                                            Alamat & Nomor telepon. Hal ini bertujuan untuk keamanan aset & informasi
                                            Laboratorium Instrumentasi Nuklir.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div><!-- End F.A.Q Group 1 -->

            </div>

            <div class="col-lg-6">

                <!-- F.A.Q Group 2 -->
                <div class="card my-1">
                    <div class="card-body">
                        <h5 class="card-title">Peminjaman & Pengembalian</h5>

                        <div class="accordion accordion-flush" id="faq-group-2">

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-1" type="button"
                                        data-bs-toggle="collapse">
                                        Bagaimana cara mengajukan peminjaman?
                                    </button>
                                </h2>
                                <div id="faqsTwo-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                                    <div class="accordion-body">
                                        <p>
                                        <ol>
                                            <li>Buka halaman detail barang / sumber radioaktif yang hendak dipinjam</li>
                                            <li>Tekan tombol pinjam dan isi data yang diperlukan.</li>
                                            <li>Tunggu admin memverifikasi pinjaman.</li>
                                            <li>Apabila pinjaman disetujui, silakan datang ke Laboratorium Instrumentasi
                                                Nuklir pada jam kerja.</li>
                                            <li>Ketentuan di lapangan mengikuti peraturan laboratorium.</li>
                                        </ol>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-1" type="button"
                                        data-bs-toggle="collapse">
                                        Bagaimana cara mengajukan peminjaman?
                                    </button>
                                </h2>
                                <div id="faqsTwo-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                                    <div class="accordion-body">
                                        <p>
                                        <ol>
                                            <li>Buka halaman detail barang / sumber radioaktif yang hendak dipinjam</li>
                                            <li>Tekan tombol pinjam dan isi data yang diperlukan.</li>
                                            <li>Tunggu admin memverifikasi pinjaman.</li>
                                            <li>Apabila pinjaman disetujui, silakan datang ke Laboratorium Instrumentasi
                                                Nuklir pada jam kerja.</li>
                                            <li>Ketentuan di lapangan mengikuti peraturan laboratorium.</li>
                                        </ol>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-7" type="button"
                                        data-bs-toggle="collapse">
                                        Apakah bisa mengajukan pinjaman di hari libur?
                                    </button>
                                </h2>
                                <div id="faqsTwo-7" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                                    <div class="accordion-body">
                                        <p>
                                            <strong>Bisa!</strong> Namun, perlu diketahui proses verifikasi pengajuan tetap
                                            dilakukan di waktu kerja.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-3" type="button"
                                        data-bs-toggle="collapse">
                                        Pengajuan pinjaman sumber ditolak?
                                    </button>
                                </h2>
                                <div id="faqsTwo-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                                    <div class="accordion-body">
                                        <p>
                                            Pertama, lihat catatan verifikasi. Jika kurang jelas, beberapa kemungkinan
                                            alasan pengajuan peminjaman sumber radioaktif ditolak adalah : <br>
                                        <ol>
                                            <li>Nama akun tidak jelas</li>
                                            <li>Pengajuan pinjaman lebih dari 1 hari</li>
                                            <li>Anda belum menghubungi pengelola laboratorium untuk berkonsultasi terkait
                                                peminjaman sumber</li>
                                        </ol>

                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-4" type="button"
                                        data-bs-toggle="collapse">
                                        Bagaimana prosedur pengembalian ?
                                    </button>
                                </h2>
                                <div id="faqsTwo-4" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                                    <div class="accordion-body">
                                        <p>
                                            Silakan <strong> datang langsung</strong> ke Laboratorium Instrumentasi Nuklir.
                                            Temui pengelola laboratorium. Selanjutnya pengembalian akan diverifikasi oleh
                                            pengelola laboratorium.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-5" type="button"
                                        data-bs-toggle="collapse">
                                        Bagaimana jika pengembalian melewati batas waktu dari yang diajukan?
                                    </button>
                                </h2>
                                <div id="faqsTwo-5" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                                    <div class="accordion-body">
                                        <p>
                                            Hal ini tergantung pada kebijakan Laboratorium Instrumentasi Nuklir.
                                            Barang yang dipinjam tetap harus dikembalikan langsung ke Laboratorium meskipun
                                            telah melewati batas waktu yang diajukan.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div><!-- End F.A.Q Group 2 -->

                <!-- F.A.Q Group 3 -->
                <div class="card my-1">
                    <div class="card-body">
                        <h5 class="card-title">Pertanyaan Lain</h5>

                        <div class="accordion accordion-flush" id="faq-group-3">

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsThree-1"
                                        type="button" data-bs-toggle="collapse">
                                        Bagaimana melihat data pencatatan penggunaan detektor?
                                    </button>
                                </h2>
                                <div id="faqsThree-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                                    <div class="accordion-body">
                                        <p>
                                            Catatan penggunaan detektor terdapat di menu yang sama dengan menu alat. Silakan
                                            buka sidebar.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsThree-2"
                                        type="button" data-bs-toggle="collapse">
                                        Apakah username dapat digunakan untuk login?
                                    </button>
                                </h2>
                                <div id="faqsThree-2" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                                    <div class="accordion-body">
                                        <p>
                                            Sampai saat ini fitur tersebut masih dikembangkan. Silakan login menggunakan
                                            email dan kata sandi. Atau gunakan sosial media yang tersedia.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsThree-3"
                                        type="button" data-bs-toggle="collapse">
                                        Jika melakukan kegiatan berkelompok, apakah semua orang harus melakukan presensi?
                                    </button>
                                </h2>
                                <div id="faqsThree-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                                    <div class="accordion-body">
                                        <p>
                                            Hal ini tergantung dari kebijakan pengelola laboratorium.
                                            Disarankan setiap individu melakukan presensi mandiri. Hal ini dimaksudkan untuk
                                            meningkatkan akurasi data sistem ini dengan kondisi riil di lapangan.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsThree-4"
                                        type="button" data-bs-toggle="collapse">
                                        Melakukan request dokumen untuk di unggah di sistem
                                    </button>
                                </h2>
                                <div id="faqsThree-4" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                                    <div class="accordion-body">
                                        <p>
                                            Silakan langsung menghubungi pengelola laboratorium untuk mengusulkan
                                            pengunggahan dokumen yang diperlukan.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsThree-5"
                                        type="button" data-bs-toggle="collapse">
                                        Grafik Peluruhan radioaktif terlihat kecil?
                                    </button>
                                </h2>
                                <div id="faqsThree-5" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                                    <div class="accordion-body">
                                        <p>
                                            Fitur tersebut sedang dikembangkan. Untuk saat ini, disarankan menggunakan PC
                                            untuk mengakses seluruh fitur di sistem.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div><!-- End F.A.Q Group 3 -->

            </div>

        </div>
    </section>
@endsection
