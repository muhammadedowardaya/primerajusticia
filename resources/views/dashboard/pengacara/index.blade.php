@extends('dashboard.layouts.main')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pengacara</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="table-responsive">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-4" id="btnPengacara" data-bs-toggle="modal"
                    data-bs-target="#pengacaraModal">
                    Create New Pengacara
                </button>
                <table class="table table-striped table-md">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p style="color:red;">
                                {{ $error }}
                            </p>
                        @endforeach
                    @endif
                    <thead>
                        <tr>
                            {{-- <th scope="col">No</th> --}}
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Instagram</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($pengacara))
                            @foreach ($pengacaras as $pengacara)
                                <tr id="{{ $pengacara->id }}">
                                    {{-- <td scope="row">{{ $posts->perPage() * ($posts->currentPage() - 1) + $loop->iteration }}</td> --}}
                                    <td>{{ $pengacara->nama }}</td>
                                    <td>{{ $pengacara->email }}</td>
                                    <td>{{ $pengacara->jabatan }}</td>
                                    <td>{{ $pengacara->whatsapp }}</td>
                                    <td>{{ $pengacara->instagram }}</td>
                                    <td>
                                        @if ($pengacara->image == null)
                                            No Image
                                        @else
                                            <img src="{{ asset('storage/images/pengacara/' . $pengacara->image) }}" alt=""
                                                class="img-fluid img-thumbnail" width="80px">
                                        @endif
                                    </td>
                                    <td>
                                        <button id="btnEditPengacara" class="badge bg-warning border-0"
                                            data-id="{{ $pengacara->id }}" data-nama="{{ $pengacara->nama }}"
                                            data-bs-toggle="modal" data-bs-target="#pengacaraModal">
                                            <span data-feather="edit" stroke-width="2"></span>
                                        </button>
                                        {{-- <form action="{{ route('pengacara.destroy', $pengacara->id) }}" method="pengacara"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge bg-danger border-0 btnHapus"
                                            data-slug="{{ $pengacara->id }}">
                                            <span data-feather="trash" stroke-width="2"></span>
                                        </button>
                                    </form> --}}
                                        <a class="badge bg-danger border-0 btnHapus mt-2" data-id="{{ $pengacara->id }}"
                                            data-id="{{ $pengacara->id }}">
                                            <span data-feather="trash" stroke-width="2"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Belum ada Pengacara</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- {{ $pengacara->links() }} --}}

    {{-- Modal create new pengacara --}}


    <!-- Modal -->
    <div class="modal fade" id="pengacaraModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pengacaraModalLabel">Add New Pengacara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pengacara.store') }}" method="post" enctype="multipart/form-data" id="form">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{-- @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif --}}
                        <input type="hidden" name="_method" value="post" id="method">
                        <input type="hidden" name="oldImage" value="{{ $pengacara->image ?? '' }}" id="oldImage">
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
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                value="{{ old('email') }}" name="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan"
                                value="{{ old('jabatan') }}" name="jabatan">
                            @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="whatsapp" class="form-label">Whatsapp</label>
                            <input type="text" placeholder="Isi Nomor Whatsapp"
                                class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp"
                                value="{{ old('whatsapp') }}" name="whatsapp">
                            @error('whatsapp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" placeholder="@namaakun"
                                class="form-control @error('instagram') is-invalid @enderror" id="instagram"
                                value="{{ old('instagram') }}" name="instagram">
                            @error('instagram')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="link_instagram" class="form-control-label">Link</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" placeholder="Masukkan URL ke Instagram Anda"
                                        class="form-control @error('link_instagram') is-invalid @enderror"
                                        id="link_instagram" value="{{ old('link_instagram') }}" name="link_instagram">
                                    @error('link_instagram')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label gambar">Foto</label>
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
                        <button type="submit" id="btnAddPengacara" class="btn btn-primary">Save changes</button>
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
                // const slug = btnHapus.getAttribute('data-slug');

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
                            url: `{{ url('dashboard/pengacara/${id}') }}`,
                            data: _token,
                            // dataType: "json",
                            success: function(response) {
                                $("#" + id).remove();
                                Toast_Post.fire({
                                    icon: 'success',
                                    title: 'Data Pengacara berhasil dihapus!'
                                })
                                // console.log(json_encode(response));
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
                            text: 'Data pengacara kamu aman.',
                            imageUrl: "{{ asset('sticker/angel.png') }}",
                            imageWidth: 200,
                            imageHeight: 200,
                            imageAlt: 'Custom image'
                        })
                    }
                });
            });
        });

        // tombol tambah kategori modal
        const btnPengacara = document.querySelector('#btnPengacara');
        // kategori modal
        const pengacaraModal = document.querySelector('#pengacaraModal');
        // tombol submit add
        const btnAddPengacara = document.querySelector('#btnAddPengacara');
        // tombol edit
        const btnEditPengacara = document.querySelectorAll('#btnEditPengacara');

        btnPengacara.addEventListener('click', function() {
            gsap.fromTo(pengacaraModal, {
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

        btnEditPengacara.forEach(update => {
            update.addEventListener('click', function() {
                // tambahkan animasi
                gsap.fromTo(pengacaraModal, {
                    duration: 2,
                    ease: "elastic.out(1, 0.3)",
                    y: -70
                }, {
                    duration: 2,
                    ease: "elastic.out(1, 0.3)",
                    y: -10
                });

                btnAddPengacara.innerHTML = 'Update Pengacara';
                document.querySelector('#pengacaraModalLabel').innerHTML = 'Update Pengacara';
                // <meta name="csrf-token" content="{{ csrf_token() }}">
                const nama = update.getAttribute('data-nama');
                const id = update.getAttribute('data-id');

                $('#nama').val(nama);

                const _token = $('meta[name="csrf-token"]').attr('content');
                $("#method").val("PATCH");
                $("#form").attr('action', `{{ url('dashboard/pengacara/${id}') }}`);

                const imgPreview = document.querySelector('.img-preview');

                const json = {
                    "id": id
                }

                // ganti gambar
                $.ajax({
                    type: "post",
                    url: `{{ route('pengacara.getUbah') }}`,
                    data: JSON.stringify(json),
                    dataType: "json",
                    success: function(response) {
                        $('#nama').val(response.nama);
                        $('#email').val(response.email);
                        $('#jabatan').val(response.jabatan);
                        $('#whatsapp').val(response.whatsapp);
                        $('#instagram').val(response.instagram);
                        $('#link_instagram').val(response.link_instagram);
                        $('.img-preview').attr('src', response.image);
                        console.table(response);
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
