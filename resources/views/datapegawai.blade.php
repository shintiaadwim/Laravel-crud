@extends('layouts.admin')

@section('title', 'Data Pegawai')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1 class="m-0">Data Pegawai</h1> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Pegawai</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <a href="/add-data" class="btn btn-success mb-3">Tambah data <i class='fas fa-user-plus'></i></a>

            {{ Session::get('halaman_url') }}

            <div class="row g-3 align-items-center">
                <div class="col-auto mb-3">
                    <form action="/pegawai" method="GET">
                        <input type="search" name="search" class="form-control" placeholder="Search">
                    </form>
                </div>

                <div class="col-auto mb-3">
                    <a href="/export-pdf" class="btn btn-danger">Export PDF <i class="fas fa-file-pdf"></i></a>
                    <a href="/export-excel" class="btn btn-success mx-2">Export Excel <i class='fas fa-file-excel'></i></a>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Import data <i class='fas fa-file-alt'></i></button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/import-excel" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-grup">
                                            <input type="file" name="file" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="sumbit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="card-tools">
                <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </div> --}}

            <div class="row">
                <div class="card table-responsive p-0">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Agama</th>
                                    <th scope="col">No. Telpon</th>
                                    <th scope="col">Dibuat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $index => $row)
                                    <tr>
                                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                                        <td>{{ $row->nama }}</td>
                                        <td>
                                            <img src="{{ asset('fotopegawai/' . $row->foto) }}" style="width: 40px;">
                                        </td>
                                        <td>{{ $row->tanggal_lahir }}</td>
                                        <td>{{ $row->jeniskelamin }}</td>
                                        <td>{{ $row->religions->nama }}</td>
                                        <td>0{{ $row->notelpon }}</td>
                                        <td>{{ $row->created_at->format('D M Y') }}</td>
                                        <td>
                                            <a href="/edit/{{ $row->id }}" class="btn btn-info m-1">Edit <i
                                                    class='fas fa-edit'></i></button>
                                                <a href="#" class="btn btn-danger m-1 delete"
                                                    data-id="{{ $row->id }}" data-nama="{{ $row->nama }}"
                                                    data-nama="{{ $row->nama }}">Delete <i
                                                        class='fas fa-trash-alt'></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li> {{ $data->links() }} </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    {{-- sweetalret --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- jquery minified --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    {{-- jquery slim minified --}}
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
                                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
                                        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
                                    </script>
                                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
                                        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
                                    </script>
                                    -->

    <script>
        $('.delete').click(function() {
            var pegawaiid = $(this).attr('data-id');
            var nama = $(this).attr('data-nama');
            swal({
                    title: "Are you sure?",
                    text: "Kamu akan menghapus data pegawai dengan nama " + nama + " ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/delete/" + pegawaiid + ""
                        swal("Data berhasil dihapus!", {
                            icon: "success",
                        });
                    } else {
                        swal("Data tidak jadi dihapus!");
                    }
                });
        });
    </script>

    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        // toastr.success('berhasil');
    </script>
@endsection
