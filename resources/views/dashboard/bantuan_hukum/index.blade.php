@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bantuan Hukum</h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-4" id="btnBantuan" data-bs-toggle="modal"
                    data-bs-target="#bantuanModal">
                    New Bantuan Hukum
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            {{-- <th scope="col">No</th> --}}
                            <th scope="col">Nama</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Sub Judul</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($bantuanHukum))
                            @foreach ($bantuanHukum as $bantuan)
                                <tr id="{{ $bantuan->id }}">
                                    {{-- <td scope="row">{{ $posts->perPage() * ($posts->currentPage() - 1) + $loop->iteration }}</td> --}}
                                    <td class="text-wrap">{{ $bantuan->nama }}</td>
                                    <td>{{ $bantuan->judul }}</td>
                                    <td>{{ $bantuan->sub_judul }}</td>
                                    <td>
                                        {{ Str::limit(strip_tags($bantuan->deskripsi), 50) }}
                                        <a href="">Read
                                            More</a>
                                    </td>
                                    <td>
                                        @if ($bantuan->image == null)
                                            No Image
                                        @else
                                            <img src="{{ asset('storage/images/bantuan_hukum/' . $bantuan->image) }}"
                                                alt="" class="img-fluid img-thumbnail" width="80px">
                                        @endif
                                    </td>
                                    <td>
                                        <button id="btnEditBantuan" class="badge bg-warning border-0"
                                            data-slug="{{ $bantuan->slug }}" data-name="{{ $bantuan->name }}"
                                            data-bs-toggle="modal" data-bs-target="#bantuanModal">
                                            <span data-feather="edit" stroke-width="2"></span>
                                        </button>
                                        {{-- <form action="{{ route('categories.destroy', $bantuan->slug) }}" method="bantuan" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="badge bg-danger border-0 btnHapus"
                                        data-slug="{{ $bantuan->slug }}">
                                        <span data-feather="trash" stroke-width="2"></span>
                                    </button>
                                </form> --}}
                                        <a class="badge bg-danger border-0 btnHapus" data-slug="{{ $bantuan->slug }}"
                                            data-id="{{ $bantuan->id }}">
                                            <span data-feather="trash" stroke-width="2"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Belum ada bantuan hukum</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- {{ $categories->links() }} --}}

    {{-- Modal create new bantuan --}}


    <!-- Modal -->
    <div class="modal fade" id="bantuanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bantuanModalLabel">Add New Bantuan Hukum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('bantuan.store') }}" method="post" enctype="multipart/form-data" id="form">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{-- @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif --}}
                        <input type="hidden" name="_method" value="post" id="method">
                        <input type="hidden" name="oldImage" value="{{ $bantuan->image ?? '' }}" id="oldImage">

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                value="{{ old('nama') }}" name="nama">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                value="{{ old('judul') }}" name="judul">
                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sub_judul" class="form-label">Sub Judul</label>
                            <input type="text" class="form-control @error('sub_judul') is-invalid @enderror" id="sub_judul"
                                value="{{ old('sub_judul') }}" name="sub_judul">
                            @error('sub_judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>

                            <input id="deskripsi" type="hidden" name="deskripsi"
                                class="@error('deskripsi') is-invalid @enderror" value="{{ old('deskripsi') }}">
                            <trix-editor input="deskripsi"></trix-editor>
                            @error('deskripsi')
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
                        <button type="submit" id="btnAddBantuan" class="btn btn-primary">Save changes</button>
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
                            url: `{{ url('dashboard/bantuan/${id}') }}`,
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
        const btnBantuan = document.querySelector('#btnBantuan');
        // kategori modal
        const bantuanModal = document.querySelector('#bantuanModal');
        // tombol submit add
        const btnAddBantuan = document.querySelector('#btnAddBantuan');
        // tombol edit
        const btnEditBantuan = document.querySelectorAll('#btnEditBantuan');

        btnBantuan.addEventListener('click', function() {
            gsap.fromTo(bantuanModal, {
                duration: 2,
                ease: "elastic.out(1, 0.3)",
                y: -70
            }, {
                duration: 2,
                ease: "elastic.out(1, 0.3)",
                y: -10
            });
            $('#nama').val('');
            $('#judul').val('');
            $('#sub_judul').val('');
            $('#deskripsi').val('');
            $('.img-preview').attr('src', '');
        });

        btnEditBantuan.forEach(update => {
            update.addEventListener('click', function() {
                // tambahkan animasi
                gsap.fromTo(bantuanModal, {
                    duration: 2,
                    ease: "elastic.out(1, 0.3)",
                    y: -70
                }, {
                    duration: 2,
                    ease: "elastic.out(1, 0.3)",
                    y: -10
                });

                btnAddBantuan.innerHTML = 'Update';
                document.querySelector('#bantuanModalLabel').innerHTML = 'Update Bantuan Hukum';
                // <meta name="csrf-token" content="{{ csrf_token() }}">
                const nama = update.getAttribute('data-nama');
                const id = update.getAttribute('data-slug');

                $('#nama').val(nama);

                const _token = $('meta[name="csrf-token"]').attr('content');
                $("#method").val("PATCH");

                $("#form").attr('action', `{{ url('dashboard/bantuan/${slug}') }}`);

                const imgPreview = document.querySelector('.img-preview');

                const json = {
                    "id": id
                }

                // ganti gambar
                $.ajax({
                    type: "post",
                    url: `{{ route('bantuan.getUbah') }}`,
                    data: JSON.stringify(json),
                    dataType: "json",
                    success: function(response) {
                        $("#nama").val(response.nama);
                        $("#judul").val(response.judul);
                        $("#sub_judul").val(response.sub_judul);
                        $("#deskripsi").val(response.deskripsi);
                        $('.img-preview').attr('src',
                            `{{ asset('storage/images/bantuan_hukum/${response.image}') }}`
                        );
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
