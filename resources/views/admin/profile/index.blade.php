@extends('layouts.master')
@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp
    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Data </h5>
                <div class="col-sm-4">
                    @if ($count > 0)
                    @else
                        <a class="btn btn-primary m-3" href="/dashboard/profil/create"> Tambah Data</a>
                    @endif
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Visi </th>
                                <th>Misi </th>
                                <th style="width: 10px">Aksi </th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php
                                $limit = 50;
                            @endphp
                            <tr>
                                @foreach ($data as $p)
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Str::limit(strip_tags($p->visi), $limit, '...') }}</td>
                                    <td>{{ Str::limit(strip_tags($p->misi), $limit, '...') }}</td>
                                    <td>
                                        <form action="/dashboard/profil/{{ $p->id_profile }}" method="POST">
                                            <a
                                                href="/dashboard/profil/{{ $p->id_profile }}/edit"class="btn btn-success  btn-sm">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"> <i
                                                    class="bx bx-trash"></i></button>
                                        </form>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
