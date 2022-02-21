@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Profile</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="table-responsive">
                <!-- Button trigger modal -->
                {{-- <button type="button" class="btn btn-primary mb-4" id="btnProfile" data-bs-toggle="modal"
                    data-bs-target="#profileModal">
                    Create New Profile
                </button> --}}
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
                            <th scope="col">Alamat</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Link Video</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($profile))
                            <tr id="{{ $profile->id }}">
                                {{-- <td scope="row">{{ $posts->perPage() * ($posts->currentPage() - 1) + $loop->iteration }}</td> --}}
                                <td>{{ $profile->alamat ?? '' }}</td>
                                <td>{{ $profile->phone ?? '' }}</td>
                                <td>{{ $profile->email ?? '' }}</td>
                                <td>{{ $profile->link_video ?? '' }}</td>
                                <td>
                                    <button id="btnEditProfile" class="badge bg-warning border-0"
                                        data-id="{{ $profile->id }}" data-nama="{{ $profile->nama }}"
                                        data-bs-toggle="modal" data-bs-target="#profileModal">
                                        <span data-feather="edit" stroke-width="2"></span>
                                    </button>
                                    {{-- <form action="{{ route('profile.destroy', $profile->id) }}" method="profile"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge bg-danger border-0 btnHapus"
                                            data-slug="{{ $profile->id }}">
                                            <span data-feather="trash" stroke-width="2"></span>
                                        </button>
                                    </form> --}}
                                    {{-- <a class="badge bg-danger border-0 btnHapus mt-2" data-id="{{ $profile->id }}"
                                            data-id="{{ $profile->id }}">
                                            <span data-feather="trash" stroke-width="2"></span>
                                        </a> --}}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- {{ $profile->links() }} --}}

    {{-- Modal create new profile --}}


    <!-- Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data" id="form">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{-- @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif --}}
                        <input type="hidden" name="_method" value="post" id="method">
                        {{-- <input type="hidden" name="oldImage" value="{{ $profile->image ?? '' }}" id="oldImage"> --}}
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                value="{{ old('alamat') }}" name="alamat">
                            @error('alamat')
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
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                value="{{ old('phone') }}" name="phone">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="link_video" class="form-label">Link Video</label>
                            <input type="text" placeholder="Isi link video untuk profile"
                                class="form-control @error('link_video') is-invalid @enderror" id="link_video"
                                value="{{ old('link_video') }}" name="link_video">
                            @error('link_video')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddProfile" class="btn btn-primary">Save changes</button>
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
                            url: `{{ url('dashboard/profile/${id}') }}`,
                            data: _token,
                            // dataType: "json",
                            success: function(response) {
                                $("#" + id).remove();
                                Toast_Post.fire({
                                    icon: 'success',
                                    title: 'Data Profile berhasil dihapus!'
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
                            text: 'Data profile kamu aman.',
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
        const btnProfile = document.querySelector('#btnProfile');
        // kategori modal
        const profileModal = document.querySelector('#profileModal');
        // tombol submit add
        const btnAddProfile = document.querySelector('#btnAddProfile');
        // tombol edit
        const btnEditProfile = document.querySelector('#btnEditProfile');

        // btnProfile.addEventListener('click', function() {
        //     gsap.fromTo(profileModal, {
        //         duration: 2,
        //         ease: "elastic.out(1, 0.3)",
        //         y: -70
        //     }, {
        //         duration: 2,
        //         ease: "elastic.out(1, 0.3)",
        //         y: -10
        //     });
        //     $('#name').val('');
        //     $('.img-preview').attr('src', '');
        // });

        btnEditProfile.addEventListener('click', function() {
            // tambahkan animasi
            gsap.fromTo(profileModal, {
                duration: 2,
                ease: "elastic.out(1, 0.3)",
                y: -70
            }, {
                duration: 2,
                ease: "elastic.out(1, 0.3)",
                y: -10
            });

            btnAddProfile.innerHTML = 'Update Profile';
            document.querySelector('#profileModalLabel').innerHTML = 'Update Profile';
            // <meta name="csrf-token" content="{{ csrf_token() }}">
            const nama = btnEditProfile.getAttribute('data-nama');
            const id = btnEditProfile.getAttribute('data-id');

            $('#nama').val(nama);

            const _token = $('meta[name="csrf-token"]').attr('content');
            $("#method").val("PATCH");
            $("#form").attr('action', `{{ url('dashboard/profile/${id}') }}`);

            const imgPreview = document.querySelector('.img-preview');

            const json = {
                "id": id
            }

            // ganti gambar
            $.ajax({
                type: "post",
                url: `{{ route('profile.getUbah') }}`,
                data: JSON.stringify(json),
                dataType: "json",
                success: function(response) {
                    $('#alamat').val(response.alamat);
                    $('#email').val(response.email);
                    $('#phone').val(response.phone);
                    $('#link_video').val(response.link_video);
                }
            });

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
