@extends('layouts.stisla.index', ['title' => 'Halaman Data Barang', 'page_heading' => 'Kelola Barang'])

@section('content')
<div class="card">

  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        {{$errors->first()}}
      </div>
    </div>
  @endif

  @if (session()->has('sukses'))
    <div class="alert alert-success alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        {{session()->get('sukses')}}
      </div>
    </div>
  @endif

  <div class="row">
    <div class="col-lg-12">

    </div>
  </div>
  <hr>
  <div class="row px-3 py-3">
    
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Kode Trx</th>
              <th scope="col">Status Trx</th>
              <th>Harga Total</th>
              <th scope="col">Tanggal</th>
              <th scope="col">aksi</th>
            </tr>
          </thead>
          <tbody>

            @foreach($data as $commodity)

          <?php
          if ($commodity->status==1){
            $id = 'barang masuk';
          }else{
            $id = 'barang keluar';
          }
          ?>
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $commodity->kode_trx }}</td>
              <td>{{ $id}}</td>
              <td>{{ $commodity->harga_total }}</td>
              <td>{{ $commodity->created_at }}</td>
              <td>

              <a data-id="{{ $commodity->id_trx_barang }}" data-kode="{{ $commodity->kode_trx }}" data-status="{{ $commodity->status }}" class="btn btn-sm btn-info text-white show_modal" title="Lihat Detail">
                  <i class="fas fa-fw fa-info"></i>
                </a>

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

@push('modal')
@include('laporan.modal.show')
@include('laporan.modal.import')
@endpush

@push('js')
@include('laporan._script')
@endpush