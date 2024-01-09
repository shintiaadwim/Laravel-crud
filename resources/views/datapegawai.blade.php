<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Crud Laravel 10</title>
</head>

<body>
    <h1 class="text-center mb-5">Data Pegawai</h1>

    <div class="container">
        <a href="/add-data" class="btn btn-success mb-3">Tambah data +</a>

        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <form action="/pegawai" method="GET">
                    <input type="search" name="search" class="form-control" placeholder="Search">
                </form>
            </div>

            <div class="col-auto">
                <a href="/export-pdf" class="btn btn-danger">Export PDF</a>
                <a href="/export-excel" class="btn btn-success ms-2">Export Excel</a>

                <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import data
                </button>

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

        <div class="row">
            {{-- @if ($message = Session::get('success'))
                <div class="alert alert-success mb-3" role="alert">
                    {{ $message }}
                </div>
            @endif --}}
            <table class="table mt-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Jenis Kelamin</th>
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
                            <td>{{ $row->jeniskelamin }}</td>
                            <td>0{{ $row->notelpon }}</td>
                            <td>{{ $row->created_at->format('D M Y') }}</td>
                            <td>
                                <a href="/edit/{{ $row->id }}" class="btn btn-info m-1">Edit</button>
                                    <a href="#" class="btn btn-danger m-1 delete" data-id="{{ $row->id }}"
                                        data-nama="{{ $row->nama }}" data-nama="{{ $row->nama }}">Delete</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $data->links() }}
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
</body>

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

</html>
