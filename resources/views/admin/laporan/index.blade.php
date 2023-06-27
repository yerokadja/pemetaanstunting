@extends('layouts.master')
@section('content')
<div class="content-wrapper"> 
  
  <div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
    <h5 class="card-header">Laporan</h5>
    <div class="col-sm-4">
      <a class="btn btn-primary" href="/laporan/create"> Tambah Data</a>
    </div>
   
    
    
    <div class="table-responsive text-nowrap">
      <table class="table"> 
        <thead class="table-light">
          <tr>
            <th>No.</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Jumlah Pasien</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
         <tr>
          @foreach ($laporan as $m)
          <td>{{ $loop->iteration  }}</td>
          <td>{{ $m->bulan }}</td>
          <td>{{ $m->tahun }}</td>
          <td>{{ $m->jumlah_pasien }}</td>
          <td>
            <form action="/laporan/hapus/{{ $m->id }}" method="POST">
              <a href="/laporan/edit/{{ $m->id }}"class="btn btn-danger btn-sm"> <i class="bx bx-edit-alt"></i></a>
              @csrf
              @method('DELETE')
            <button type="submit" href="{{ $m->id }} </a>" class="btn btn-primary btn-sm"> <i class="bx bx-trash"></i></button>
          </form>
          </td>
         </tr> 
          @endforeach
          
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
@endsection