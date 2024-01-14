@extends('layouts.admin')

@section('title', 'Data Agama')

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
                            <li class="breadcrumb-item active">Data Agama</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <a href="/add-religion" class="btn btn-success mb-3">Tambah data <i class='fas fa-user-plus'></i></a>

            {{-- {{ Session::get('halaman_url') }} --}}

            <div class="row mt-3">
                <div class="card table-responsive p-0">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
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
@endsection
