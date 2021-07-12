@extends('layouts.stisla.index', ['title' => 'Halaman Data Barang Keluar', 'page_heading' => 'Data Barang Keluar'])

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
      <a href="{{ route('barang.print') }}" class="btn btn-success float-right mt-3 mx-3" data-toggle="tooltip" title="Print">
        <i class="fas fa-fw fa-print"></i>
      </a>

      <button type="button" class="btn btn-primary float-right mt-3 mx-3" data-toggle="modal" data-target="#commodity_create_modal">
        <i class="fas fa-fw fa-plus"></i>
        Tambah Data
      </button>

    </div>
  </div>
  <div class="row px-3 py-3">
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Kode Barang</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Kuantitas</th>
              <!-- <th scope="col">Kondisi</th> -->
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($commodities as $commodity)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $commodity->Kode_Barang }}</td>
              <td>{{ Str::limit($commodity->Nama_Barang	, 55, '...') }}</td>
              <td>{{ $commodity->Qty }}</td>
            
              <td class="text-center">
                <a data-id="{{ $commodity->ID }}" class="btn btn-sm btn-info text-white show_modal" data-toggle="modal" data-target="#show_commodity" title="Lihat Detail">
                  <i class="fas fa-fw fa-info"></i>
                </a>
                <a data-id="{{ $commodity->ID }}" class="btn btn-sm btn-success text-white swal-edit-button" data-toggle="modal" data-target="#edit_commodity" data-placement="top" title="Ubah data">
                  <i class="fas fa-fw fa-edit"></i>
                </a>
                </a>
                <a data-id="{{ $commodity->ID }}" class="btn btn-sm btn-danger text-white swal-delete-button" data-toggle="tooltip" data-placement="top" title="Hapus data">
                  <i class="fas fa-fw fa-trash-alt"></i>
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
@include('barangkeluar.modal.show')
@include('barangkeluar.modal.create')
@include('barangkeluar.modal.edit')
@include('barangkeluar.modal.import')
@endpush

@push('js')
@include('barangkeluar._script')
@endpush