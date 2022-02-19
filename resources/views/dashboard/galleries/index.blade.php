@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gallery</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="table-responsive">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-4" id="btnGallery" data-bs-toggle="modal"
                    data-bs-target="#galleryModal">
                    Upload New Image
                </button>
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
                            <th scope="col">Image Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($galleries))
                            @foreach ($galleries as $gallery)
                                <tr id="{{ $gallery->id }}">
                                    {{-- <td scope="row">{{ $posts->perPage() * ($posts->currentPage() - 1) + $loop->iteration }}</td> --}}
                                    <td>{{ $gallery->name }}</td>
                                    <td>
                                        @if ($gallery->image == null)
                                            No Image
                                        @else
                                            <img src="{{ asset('storage/images/galleries/' . $gallery->image) }}" alt=""
                                                class="img-fluid img-thumbnail" width="80px">
                                        @endif
                                    </td>
                                    <td>
                                        <button id="btnEditGallery" class="badge bg-warning border-0"
                                            data-slug="{{ $gallery->slug }}" data-name="{{ $gallery->name }}"
                                            data-bs-toggle="modal" data-bs-target="#galleryModal">
                                            <span data-feather="edit" stroke-width="2"></span>
                                        </button>
                                        {{-- <form action="{{ route('categories.destroy', $gallery->slug) }}" method="gallery" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge bg-danger border-0 btnHapus"
                                            data-slug="{{ $gallery->slug }}">
                                            <span data-feather="trash" stroke-width="2"></span>
                                        </button>
                                    </form> --}}
                                        <a class="badge bg-danger border-0 btnHapus" data-slug="{{ $gallery->slug }}"
                                            data-id="{{ $gallery->id }}">
                                            <span data-feather="trash" stroke-width="2"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Belum ada gallery</td>
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
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalLabel">Add New Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('galleries.store') }}" method="post" enctype="multipart/form-data" id="form">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{-- @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif --}}
                        <input type="hidden" name="_method" value="post" id="method">
                        <input type="hidden" name="oldImage" value="{{ $gallery->image ?? '' }}" id="oldImage">
                        <div class="mb-3">
                            <label for="name" class="form-label">Image Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                value="{{ old('name') }}" name="name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label gambar">Image</label>
                            <img src="" class="img-preview img-fluid mb-3 col-sm-5 d-block" alt="">
                            <input class="form-control @error('image') is-invalid @enderror" name="image" type="file"
                                id="image" onchange="previewImg()">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddGallery" class="btn btn-primary">Save changes</button>
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

        btnEditGallery.forEach(update => {
            update.addEventListener('click', function() {
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

                btnAddGallery.innerHTML = 'Update Image';
                document.querySelector('#galleryModalLabel').innerHTML = 'Update Gallery Name';
                // <meta name="csrf-token" content="{{ csrf_token() }}">
                const name = update.getAttribute('data-name');
                const slug = update.getAttribute('data-slug');

                $('#name').val(name);

                const _token = $('meta[name="csrf-token"]').attr('content');
                $("#method").val("PATCH");
                $("#form").attr('action', `{{ url('dashboard/galleries/${slug}') }}`);

                const imgPreview = document.querySelector('.img-preview');

                const json = {
                    "slug": slug
                }

                // ganti gambar
                $.ajax({
                    type: "post",
                    url: `{{ route('galleries.getUbah') }}`,
                    data: JSON.stringify(json),
                    dataType: "json",
                    success: function(response) {
                        $('.img-preview').attr('src',
                            `{{ asset('storage/images/galleries/${response.image}') }}`);
                    }
                });

            })
        })

        function previewImg() {
            const gambar = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            gambar.textContent = gambar.files[0].name;

            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambar.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
@endsection
