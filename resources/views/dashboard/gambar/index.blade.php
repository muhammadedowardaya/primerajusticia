@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gambar Halaman Profile</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="table-responsive">
                <!-- Button trigger modal -->
                {{-- <button type="button" class="btn btn-primary mb-4" id="btnGallery" data-bs-toggle="modal"
                    data-bs-target="#galleryModal">
                    Upload New Image
                </button> --}}
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <p style="color: red">
                                    {{ $error }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            {{-- <th scope="col">No</th> --}}
                            <th scope="col">Hero Image</th>
                            <th scope="col">Background About</th>
                            <th scope="col">About Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($gambar))
                            <tr id="{{ $gambar->id }}">
                                {{-- <td scope="row">{{ $posts->perPage() * ($posts->currentPage() - 1) + $loop->iteration }}</td> --}}
                                <td>
                                    @if (is_null($gambar->hero))
                                        No Image
                                    @else
                                        <img src="{{ asset('storage/images/gambar/' . $gambar->hero) }}" alt=""
                                            class="img-fluid img-thumbnail" width="80px">
                                    @endif
                                </td>
                                <td>
                                    @if (is_null($gambar->bg_about))
                                        No Image
                                    @else
                                        <img src="{{ asset('storage/images/gambar/' . $gambar->bg_about) }}" alt=""
                                            class="img-fluid img-thumbnail" width="80px">
                                    @endif
                                </td>
                                <td>
                                    @if (is_null($gambar->about))
                                        No Image
                                    @else
                                        <img src="{{ asset('storage/images/gambar/' . $gambar->about) }}" alt=""
                                            class="img-fluid img-thumbnail" width="80px">
                                    @endif
                                </td>
                                <td>
                                    <button id="btnEditGambar" class="badge bg-warning border-0"
                                        data-id="{{ $gambar->id }}" data-name="{{ $gambar->name }}"
                                        data-bs-toggle="modal" data-bs-target="#galleryModal">
                                        <span data-feather="edit" stroke-width="2"></span>
                                    </button>
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- {{ $categories->links() }} --}}

    {{-- Modal create new gallery --}}


    <!-- Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalLabel">Update Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('gambar.update', $gambar->id) }}" method="post" enctype="multipart/form-data"
                    id="form">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        @method('PATCH')
                        {{-- @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif --}}
                        {{-- <input type="hidden" name="_method" value="post" id="method"> --}}
                        <input type="hidden" name="oldHero" value="{{ $gambar->hero ?? '' }}" id="oldHero">
                        <input type="hidden" name="oldBg_about" value="{{ $gambar->bg_about ?? '' }}" id="oldBg_about">
                        <input type="hidden" name="oldAbout" value="{{ $gambar->about ?? '' }}" id="oldAbout">

                        <div class="mb-3">
                            <label for="hero" class="form-label hero">Hero Image</label>
                            <img src="" class="hero-preview img-fluid mb-3 col-sm-5 d-block" alt="">
                            <input class="form-control @error('hero') is-invalid @enderror" name="hero" type="file"
                                id="hero" onchange="previewHero()">
                            @error('hero')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bg_about" class="form-label bg_about">Background Image About</label>
                            <img src="" class="bg_about-preview img-fluid mb-3 col-sm-5 d-block" alt="">
                            <input class="form-control @error('bg_about') is-invalid @enderror" name="bg_about" type="file"
                                id="bg_about" onchange="previewBg_about()">
                            @error('hero')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="about" class="form-label about">About Image</label>
                            <img src="" class="about-preview img-fluid mb-3 col-sm-5 d-block" alt="">
                            <input class="form-control @error('about') is-invalid @enderror" name="about" type="file"
                                id="about" onchange="previewAbout()">
                            @error('about')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const btnEditGambar = document.querySelector('#btnEditGambar');
        const hapus = document.querySelectorAll('a.btnHapus');
        hapus.forEach(btnHapus => {
            btnHapus.addEventListener('click', (e) => {
                e.preventDefault();

                const id = btnHapus.getAttribute('data-id');
                const slug = btnHapus.getAttribute('data-slug');

                var _token = $('meta[name=csrf-token]').attr('content');

                Swal.fire({
                    title: 'Apa kamu yakin?',
                    text: "Kamu tidak dapat mengembalikan data ini!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Tidak, batal!',
                    reverseButtons: true,
                    imageUrl: "{{ asset('sticker/surprised.png') }}",
                    imageWidth: 200,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // const json = {
                        //     "id": id,
                        //     "_token": _token
                        // };
                        $.ajax({
                            type: "delete",
                            url: `{{ url('dashboard/galleries/${id}') }}`,
                            data: _token,
                            // dataType: "json",
                            success: function(response) {
                                // console.log(response);
                                $("#" + id).remove();
                                Toast_Post.fire({
                                    icon: 'success',
                                    title: 'Image berhasil dihapus!'
                                })
                            },
                            error: function(response) {
                                swalWithBootstrapButtons.fire(
                                    'Gagal!',
                                    'Data gagal dihapus.',
                                    'error'
                                )
                                // console.log(response.responseJSON);
                            },
                        });

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                            title: 'Dibatalkan!',
                            text: 'Image kamu aman.',
                            imageUrl: "{{ asset('sticker/angel.png') }}",
                            imageWidth: 200,
                            imageHeight: 200,
                            imageAlt: 'Custom image'
                        })
                    }
                });
            });
        });

        btnEditGambar.addEventListener('click', function() {
            // tambahkan animasi
            gsap.fromTo(galleryModal, {
                duration: 2,
                ease: "elastic.out(1, 0.3)",
                y: -70
            }, {
                duration: 2,
                ease: "elastic.out(1, 0.3)",
                y: -10
            });

            document.querySelector('#galleryModalLabel').innerHTML = 'Update Gambar';
            // <meta name="csrf-token" content="{{ csrf_token() }}">
            const id = btnEditGambar.getAttribute('data-id');

            $('#id').val(id);

            const _token = $('meta[name="csrf-token"]').attr('content');
            $("#method").val("PATCH");
            $("#form").attr('action', `{{ url('dashboard/gambar/${id}') }}`);

            const heroPreview = document.querySelector('.hero-preview');
            const bg_aboutPreview = document.querySelector('.bg_about-preview');
            const aboutPreview = document.querySelector('.about-preview');

            const json = {
                "id": id
            }

            // ganti gambar
            $.ajax({
                type: "post",
                url: `{{ route('gambar.getUbah') }}`,
                data: JSON.stringify(json),
                dataType: "json",
                success: function(response) {
                    $('.hero-preview').attr('src',
                        `{{ asset('storage/images/gambar/${response.hero}') }}`);
                    $('.bg_about-preview').attr('src',
                        `{{ asset('storage/images/gambar/${response.bg_about}') }}`);
                    $('.about-preview').attr('src',
                        `{{ asset('storage/images/gambar/${response.about}') }}`);
                    console.table(response);
                }
            });

        })


        // tombol tambah image modal
        const btnGallery = document.querySelector('#btnGallery');
        // kategori modal
        const galleryModal = document.querySelector('#galleryModal');
        // tombol submit add
        const btnAddGallery = document.querySelector('#btnAddGallery');
        // tombol edit
        const btnEditGallery = document.querySelectorAll('#btnEditGallery');

        btnGallery.addEventListener('click', function() {
            gsap.fromTo(galleryModal, {
                duration: 2,
                ease: "elastic.out(1, 0.3)",
                y: -70
            }, {
                duration: 2,
                ease: "elastic.out(1, 0.3)",
                y: -10
            });
            $('#name').val('');
            $('.img-preview').attr('src', '');
        });


        function previewHero() {
            const hero = document.querySelector('#hero');
            const heroPreview = document.querySelector('.hero-preview');

            hero.textContent = hero.files[0].name;

            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(hero.files[0]);

            fileGambar.onload = function(e) {
                heroPreview.src = e.target.result;
            }
        }

        function previewBg_about() {
            const bg_about = document.querySelector('#bg_about');
            const bg_aboutPreview = document.querySelector('.bg_about-preview');

            bg_about.textContent = bg_about.files[0].name;

            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(bg_about.files[0]);

            fileGambar.onload = function(e) {
                bg_aboutPreview.src = e.target.result;
            }
        }

        function previewAbout() {
            const about = document.querySelector('#about');
            const aboutPreview = document.querySelector('.about-preview');

            about.textContent = about.files[0].name;

            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(about.files[0]);

            fileGambar.onload = function(e) {
                aboutPreview.src = e.target.result;
            }
        }
    </script>
@endsection
