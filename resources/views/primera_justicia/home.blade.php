@extends('layouts.main')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center"
        style="background-image: url('{{ asset('storage/images/gambar/' . $gambar->hero ?? '') }}')">
        <div class="container position-relative text-center text-lg-start aos-init aos-animate" data-aos="zoom-in"
            data-aos-delay="100">
            <div class="row">
                <div class="col-lg-8">
                    <h1><span>Primera Justicia</span></h1>
                    <!-- <h2>Pengacara &amp; Konsultan Hukum Terbaik <br> Konsultasi Masalah Hukum Gratis</h2> -->
                    <h2>Forum Kajian &amp; Pelayanan Hukum Tingkat Nasional <br> Yang Berwibawa</h2>

                    <div class="btns">
                        <a href="#menu" class="btn-menu animated fadeInUp scrollto">Pengacara</a>
                        <a href="#book-a-table" class="btn-book animated fadeInUp scrollto">Janji Temu</a>
                    </div>
                </div>
                <div class="col-lg-4 d-flex align-items-center justify-content-center position-relative aos-init aos-animate"
                    data-aos="zoom-in" data-aos-delay="200">
                    <!-- <a href="https://www.youtube.com/watch?v=CX-NKdY-_Tc&amp;feature=youtu.be"
                                            class="glightbox play-btn">
                                    </a> -->
                    @if (isset($profile->link_video))
                        <a href="{{ $profile->link_video }}"></a>
                    @else
                        <a href="https://www.youtube.com/watch?v=N-iGaRaqXbE&list=PLJn69VMQAr8oMLfFgStCGZNK4foJL9uyS&index=193"
                            class="glightbox play-btn"></a>
                    @endif

                </div>

            </div>
        </div>
    </section>
    <!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about"
            style="background-image: url('{{ asset('storage/images/gambar/' . $gambar->bg_about ?? '') }}')">
            <div class="container aos-init" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-6 order-1 order-lg-2 aos-init" data-aos="zoom-in" data-aos-delay="100">
                        <div class="about-img">
                            @if (isset($gambar->about))
                                <img src="{{ asset('storage/images/gambar/' . $gambar->about) }}" alt="">
                            @else
                                <p>Belum ada gambar</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                        <h3>Kantor Advokat, Pengacara &amp; Konsultan Hukum Primera Justicia.</h3>
                        <p class="fst-italic">
                            Bergerak dibidang Jasa Konsultan Hukum yang siap membantu permasalahan anda.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> Menyelenggarakan Pelatihan hukum praktis bagi para
                                mahasiswa dari berbagai perguruan tinggi.</li>
                            <li><i class="bi bi-check-circle"></i> Membantu penyelesaian perkara hukum masyarakat
                                berkoordinasi dengan para ahli hukum/advokat.</li>
                            <li><i class="bi bi-check-circle"></i> Bersifat terbuka, kritis dan menyediakan SDM sebagai
                                narasumber bidang keterampilan hukum</li>
                        </ul>
                        <p>
                            Dengan dukungan sarana dan prasarana yang memadai dan staf yang sangat berpengalaman dan
                            profesional serta memiliki kemampuan di bidangnya masing-masing, maka kami siap menjalin
                            kerjasama dan menjadi partner semua pihak dalam berbagai bidang hukum.
                        </p>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->
        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container aos-init" data-aos="fade-up">

                <div class="section-title">
                    <h2>Mengapa Kami?</h2>
                    <p>Mengapa Memilih Kami ?</p>
                </div>

                <div class="row">

                    <div class="col-lg-4">
                        <div class="box aos-init" data-aos="zoom-in" data-aos-delay="100">
                            <span>01</span>
                            <h4>COMPANY VALUE</h4>
                            <p>Guna mencapai Visi dan Misi . Maka Kantor Hukum 'Primera Justicia' mempunyai
                                KOMITMEN bersama dalam memberikan pelayanan hukum terbaik secara maksimal terhadap para
                                Pencari
                                Keadilan</p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <div class="box aos-init" data-aos="zoom-in" data-aos-delay="200">
                            <span>02</span>
                            <h4>MORALITAS</h4>
                            <p>Kantor Hukum 'Primera Justicia' sangat Menjunjung tinggi Moralitas, yang
                                mana Faktor Kejujuran adalah merupakan Landasan utama dalam menjalankan setiap aktifitas
                                usaha kami.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <div class="box aos-init" data-aos="zoom-in" data-aos-delay="300">
                            <span>03</span>
                            <h4> KREDIBILITAS</h4>
                            <p>Kredibilitas bagi kami merupakan aspek yang dikedepankan dalam memberikan pelayanan hukum
                                kepada Klien/Mitra dan merupakan faktor utama yang penting dalam memberikan kepuasan
                                pelayanan .</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- End Why Us Section -->
        <!-- ======= Specials Section ======= -->
        <section id="specials" class="specials">
            <div class="container aos-init" data-aos="fade-up">

                <div class="section-title">
                    <h2>Bantuan Hukum</h2>
                    <p>Cek Bantuan Hukum Kami</p>
                </div>

                <div class="row aos-init" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-3">
                        <ul class="nav nav-tabs flex-column">
                            @if (isset($bantuan))
                                @foreach ($bantuans as $bantuan)
                                    <li class="nav-item">
                                        <a class="nav-link active show" data-bs-toggle="tab"
                                            href="#tab-1">{{ $bantuan->nama }}</a>
                                    </li>
                                @endforeach
                            @else
                                <li class="nav-item">
                                    <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Belum ada bantuan
                                        hukum</a>
                                </li>
                            @endif
                            {{-- <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Kasus Sengketa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Kasus Kecelakaan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Fasilitasi Penertiban
                                    Pelanggaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-4">Hak Asuh Anak</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-5">Pendampingan Client</a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="col-lg-9 mt-4 mt-lg-0">
                        <div class="tab-content">
                            @if (isset($bantuans))
                                @foreach ($bantuans as $bantuan)
                                    <div class="tab-pane active show" id="tab-1">
                                        <div class="row">
                                            <div class="col-lg-8 details order-2 order-lg-1">
                                                <h3>{{ $bantuan->judul }}</h3>
                                                <p class="fst-italic">{{ $bantuan->sub_judul }}</p>
                                                <p>{{ $bantuan->deskripsi }}</p>
                                            </div>
                                            <div class="col-lg-4 text-center order-1 order-lg-2">
                                                <img src="{{ asset('storage/images/bantuan_hukum/' . $bantuan->image) }}"
                                                    alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="tab-pane active show" id="tab-1">
                                    <div class="row">
                                        <div class="col-lg-8 details order-2 order-lg-1">
                                            <h3>Belum ada bantuan hukum</h3>
                                            <p class="fst-italic">Pemasangan Plang pada Tanah bersengketa</p>
                                            <p>Belum ada bantuan Hukum</p>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            {{-- <div class="tab-pane active show" id="tab-1">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Sengketa</h3>
                                        <p class="fst-italic">Pemasangan Plang pada Tanah bersengketa</p>
                                        <p>Kasus Sengketa Marak Terjadi dalam bisnis property maupun pada lahan yang
                                            diperjual belikan, kami dapat membantu anda untuk mengatasi masalah sengketa
                                            tanah</p>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                        <img src="img/sengketa.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Kecelakaan</h3>
                                        <p class="fst-italic">Pemeriksaan TKP kasus Kecelakaan</p>
                                        <p>Pemeriksaan lokasi kasus kecelakaan, dengan ditemani petugas untuk
                                            identifikasi lokasi kejadian perkara yang menimpa client kami</p>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                        <img src="img/kecelakaan.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-3">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Fasilitasi Penertiban Pelanggaran Tata Ruang di Kementerian ATR/BPN </h3>
                                        <p class="fst-italic">Rapat Koordinasi Bengkulu</p>
                                        <p>Rapat Koordinasi dengan Dinas Pekerjaan Umum Bina Marga dan Tata Ruang
                                            Propinsi Sumatera Selatan dalam Kegiatan Fasilitasi Penertiban Pelanggaran
                                            Tata Ruang Kementerian Agraria Tata Ruang di wilayah Propinsi Sumatera
                                            Selatan
                                            dan Propinsi Bengkulu</p>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                        <img src="img/penertiban.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-4">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Pendampingan Client Hak asuh anak</h3>
                                        <p>Pendampingan client, Pengaduan permasalahan hak asuh anak ke Komisi
                                            Perlindungan Anak Indonesia</p>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                        <img src="img/hak-asuh-anak.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-5">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Pendampingan Client Tabrak Lari</h3>
                                        <p>Pendampingan client dalam pemeriksaan pada perkara Kecelakaan Lalu Lintas
                                            yang menyebabkan korban dengan luka berat.</p>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                        <img src="img/tabrak-lari.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End Specials Section -->
        <!-- ======= Book A Table Section ======= -->
        <section id="book-a-table" class="book-a-table">
            <div class="container aos-init" data-aos="fade-up">

                <div class="section-title">
                    <h2>Permintaan</h2>
                    <p>Janji Temu</p>
                </div>

                <form action="forms/book-a-table.php" method="post" role="form" class="php-email-form aos-init"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama anda"
                                data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                            <div class="validate"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda"
                                data-rule="email " data-msg=" Please enter a valid email ">
                            <div class="validate"></div>
                        </div>
                        <div class=" col-lg-4 col-md-6 form-group mt-3 mt-md-0 ">
                            <input type=" text " class=" form-control " name=" phone" id="phone"
                                placeholder=" Nomor Telpon " data-rule=" minlen:4 "
                                data-msg=" Please enter at least 4 chars ">
                            <div class=" validate "></div>
                        </div>
                        <div class=" form-group mt-3 ">
                            <textarea class=" form-control id=" message"="" "="" name=" message" rows=" 5 "
                                placeholder=" Ceritakan Masalah Hukum Anda "></textarea>
                            <div class=" validate "></div>
                        </div>
                        <div class=" mb-3 ">
                            <div class=" loading ">Loading</div>
                            <div class=" error-message "></div>
                            <div class=" sent-message ">Janji Temu Telah dikirim, Kami akan Segera Menghubungi anda. Terima
                                Kasih!</div>
                        </div>
                        <div class=" text-center "><button type="submit" class="btn-primary">Kirim Janji Temu</button>
                        </div>
                </form>

            </div>
        </section>
        <!-- End Book A Table Section -->
        <!-- ======= Testimonials Section ======= -->
        <!--<section id=" testimonials" class="testimonials section-bg">-->
        <!--              <div class="container" data-aos="fade-up">-->

        <!--                <div class="section-title">-->
        <!--                  <h2>Testimonials</h2>-->
        <!--                  <p>Para Client</p>-->
        <!--                </div>-->

        <!--                <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">-->
        <!--                  <div class="swiper-wrapper">-->

        <!--                    <div class="swiper-slide">-->
        <!--                      <div class="testimonial-item">-->
        <!--                        <p>-->
        <!--                          <i class="bx bxs-quote-alt-left quote-icon-left"></i> Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus-->
        <!--                          at semper.-->
        <!--                          <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
        <!--                        </p>-->
        <!--                        <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">-->
        <!--                        <h3>Saul Goodman</h3>-->
        <!--                        <h4>Ceo &amp; Founder</h4>-->
        <!--                      </div>-->
        <!--                    </div>-->
        <!-- End testimonial item -->

        <!--                    <div class="swiper-slide">-->
        <!--                      <div class="testimonial-item">-->
        <!--                        <p>-->
        <!--                          <i class="bx bxs-quote-alt-left quote-icon-left"></i> Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam-->
        <!--                          anim culpa.-->
        <!--                          <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
        <!--                        </p>-->
        <!--                        <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">-->
        <!--                        <h3>Sara Wilsson</h3>-->
        <!--                        <h4>Designer</h4>-->
        <!--                      </div>-->
        <!--                    </div>-->
        <!-- End testimonial item -->

        <!--                    <div class="swiper-slide">-->
        <!--                      <div class="testimonial-item">-->
        <!--                        <p>-->
        <!--                          <i class="bx bxs-quote-alt-left quote-icon-left"></i> Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.-->
        <!--                          <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
        <!--                        </p>-->
        <!--                        <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">-->
        <!--                        <h3>Jena Karlis</h3>-->
        <!--                        <h4>Store Owner</h4>-->
        <!--                      </div>-->
        <!--                    </div>-->
        <!-- End testimonial item -->

        <!--                    <div class="swiper-slide">-->
        <!--                      <div class="testimonial-item">-->
        <!--                        <p>-->
        <!--                          <i class="bx bxs-quote-alt-left quote-icon-left"></i> Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore-->
        <!--                          labore illum veniam.-->
        <!--                          <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
        <!--                        </p>-->
        <!--                        <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">-->
        <!--                        <h3>Matt Brandon</h3>-->
        <!--                        <h4>Freelancer</h4>-->
        <!--                      </div>-->
        <!--                    </div>-->
        <!-- End testimonial item -->

        <!--                    <div class="swiper-slide">-->
        <!--                      <div class="testimonial-item">-->
        <!--                        <p>-->
        <!--                          <i class="bx bxs-quote-alt-left quote-icon-left"></i> Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam-->
        <!--                          culpa fore nisi cillum quid.-->
        <!--                          <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
        <!--                        </p>-->
        <!--                        <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">-->
        <!--                        <h3>John Larson</h3>-->
        <!--                        <h4>Entrepreneur</h4>-->
        <!--                      </div>-->
        <!--                    </div>-->
        <!-- End testimonial item -->

        <!--                  </div>-->
        <!--                  <div class="swiper-pagination"></div>-->
        <!--                </div>-->

        <!--              </div>-->
        <!--    </section>-->
        <!-- End Testimonials Section -->
        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">

            <div class="container aos-init" data-aos="fade-up">
                <div class="section-title">
                    <h2>Gallery</h2>
                    <p>Beberapa Foto dari Kantor Kami</p>
                </div>
            </div>

            <div class="container-fluid aos-init" data-aos="fade-up" data-aos-delay="100">

                @if (isset($galleries->image))
                    <div class="row g-0 d-flex justify-content-center">
                        @foreach ($galleries as $gallery)
                            <div class="col-lg-3 col-md-4">
                                <div class="gallery-item">
                                    <a href="{{ asset('storage/images/galleries/' . $gallery->image) }}"
                                        class="gallery-lightbox" data-gall="gallery-item">
                                        <img src="{{ asset('storage/images/galleries/' . $gallery->image) }}" alt=""
                                            class="img-fluid">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="row g-0 d-flex justify-content-center">
                        <div class="col-lg-3 col-md-4">
                            <div class="gallery-item">
                                <p class="text-center">Tidak ada gallery</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        <!-- End Gallery Section -->
        <!-- ======= Chefs Section ======= -->
        <section id="chefs" class="chefs">
            <div class="container aos-init" data-aos="fade-up">

                <div class="section-title">
                    <h2>Pengacara</h2>
                    <p>Pengacara Proffesional Kami</p>
                </div>


                @if (isset($pengacara->nama))
                    <div class="row">
                        @foreach ($pengacara as $item)
                            <div class="col-lg-4 col-md-6 justify-content-center">
                                <div class="member aos-init" data-aos="zoom-in" data-aos-delay="100">
                                    <img src="{{ asset('storage/images/pengacara/' . $item->image) }}"
                                        class="img-fluid" alt="">
                                    <div class="member-info">
                                        <div class="member-info-content">
                                            <h4>{{ $item->nama }}</h4>
                                            <span>{{ $item->jabatan }}</span>
                                        </div>
                                        <div class="social">
                                            <a href=""><i class="bi bi-whatsapp"></i>{{ $item->whatsapp }}</a>
                                            <a href=""><i class="bi bi-instagram"></i> {{ $item->instagram }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="member aos-init" data-aos="zoom-in" data-aos-delay="100">
                                <p>Belum ada pengacara</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        <!-- End Chefs Section -->
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container aos-init" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>Contact Us</p>
                </div>
            </div>

            <!-- google maps -->
            <!-- <div data-aos="fade-up" class="aos-init">
                                        <iframe style="border:0; width: 100%; height: 350px;"
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.3106442569797!2d106.80850601449572!3d-6.482285665181251!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c3691f4eb795%3A0x259c530712368cd!2sKANTOR%20HUKUM%20SYLVIA%20ANWAR%20%26%20REKAN%20(SAR%20LAW%20OFFICE)!5e0!3m2!1sid!2sid!4v1627379791959!5m2!1sid!2sid" frameborder="0" allowfullscreen=""></iframe>
                                    </div> -->
            <div class="container aos-init" data-aos="fade-up">
                <div class="row mt-5">
                    <div class="col-lg-4">
                        <div class="info">

                            @if (isset($profile->alamat))
                                <div class="address">
                                    <i class="bi bi-geo-alt"></i>
                                    <h4>Location:</h4>
                                    <p>{{ $profile->alamat }}</p>
                                </div>
                            @else
                                <div class="address">
                                    <i class="bi bi-geo-alt"></i>
                                    <h4>Location:</h4>
                                    <p>Ruko Graha Kartika Pratama, Blok A, No.8, Jalan Tegar Beriman, <br> Pemda Kabupaten
                                        Bogor,, Bojong Baru, Kec. Bojong Gede, Bogor, Jawa Barat 16920</p>
                                </div>
                            @endif

                            <div class="open-hours">
                                <i class="bi bi-clock"></i>
                                <h4>Open Hours:</h4>
                                <p>
                                    Senin-Jumat:<br> 08:00 - 18.00
                                </p>
                            </div>

                            @if (isset($profile->email))
                                <div class="email">
                                    <i class="bi bi-envelope"></i>
                                    <h4>Email :</h4>
                                    <p>{{ $profile->email }}</p>
                                </div>
                            @else
                                <div class="email">
                                    <i class="bi bi-envelope"></i>
                                    <h4>Email :</h4>
                                    <p>primerajusticia@gmail.com</p>
                                </div>
                            @endif

                            @if (isset($profile->phone))
                                <div class="phone">
                                    <i class="bi bi-phone"></i>
                                    <h4>Call:</h4>
                                    <p>{{ $profile->phone }}
                                    </p>
                                </div>
                            @else
                                <div class="phone">
                                    <i class="bi bi-phone"></i>
                                    <h4>Call:</h4>
                                    <p>(021) 8371 5287
                                    </p>
                                </div>
                            @endif


                        </div>

                    </div>

                    <div class="col-lg-8 mt-5 mt-lg-0">

                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                        required="">
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email" required="">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                                    required="">
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="8" placeholder="Message"
                                    required=""></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>

                    </div>

                </div>

            </div>
        </section>
        <!-- End Contact Section -->

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-info">
                            <h3>Primera Justicia</h3>
                            @if (isset($profile))
                                <p>
                                    {{ $profile->alamat }} <br>
                                    <strong>Phone :</strong> {{ $profile->phone }} <br>
                                    <strong>Email :</strong> {{ $profile->email }} <br>
                                </p>
                            @else
                                <p>
                                    Ruko Graha Kartika Pratama, Blok A, No.8, Jalan Tegar Beriman, <br> Pemda Kabupaten
                                    Bogor,, Bojong Baru, Kec. Bojong Gede, Bogor, Jawa Barat 16920<br><br>
                                    <strong>Phone:</strong> (021) 8371 5287<br>
                                    <strong>Email:</strong> primerajusticia@gmail.com<br>
                                </p>
                            @endif
                            <div class="social-links mt-3">
                                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li>
                                <i class='bx bx-chevron-right'>
                                    <a href="#">Draf Gugatan</a>
                                </i>
                            </li>
                            <li>
                                <i class='bx bx-chevron-right'>
                                    <a href="#">Perceraian</a>
                                </i>
                            </li>
                            <li>
                                <i class='bx bx-chevron-right'>
                                    <a href="#">Perkawinan</a>
                                </i>
                            </li>
                            <li>
                                <i class='bx bx-chevron-right'>
                                    <a href="#">Perselisihan</a>
                                </i>
                            </li>
                            <li>
                                <i class='bx bx-chevron-right'>
                                    <a href="#">Harta Benda</a>
                                </i>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Hubungi Kami</h4>
                        <p>Layanan Konsultasi Hukum Gratis , Siap melayani permasalahan hukum anda dengan Professional
                        </p>

                    </div>

                </div>
            </div>
        </div>

        <div class="container d-flex justify-content-between">
            <div class="copyright">
                <!-- © Copyright <strong><span>Sylvia Anwar &amp; Rekan</span></strong>. All Rights Reserved -->
                <span>Primera Justicia</span>
            </div>
            <div class="copyright">
                © Copyright 2022 | All Rights Reserved
            </div>
        </div>
    </footer>
    <!-- End Footer -->
@endsection

@section('script')
    <script>
        // const hero = document.querySelector("#hero");
        // const heroImage = hero.getAttribute('data-hero');
        // hero.style.backgroundImage = `url('../../../public/storage/images/gambar/${heroImage}')`;

        // const bg_about = document.querySelector("#bg_about");
        // const bg_aboutImage = bg_about.getAttribute('data-bg_about');
        // bg_about.style.backgroundImage = `url('../../../public/storage/images/gambar/${bg_aboutImage}')`;

        // const about = document.querySelector("#about");
        // const aboutImage = about.getAttribute('data-about');
        // about.style.backgroundImage = `url('../../../public/storage/images/gambar/${aboutImage}')`;
    </script>
@endsection
