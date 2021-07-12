@extends('layouts.stisla.index', ['title' => 'Halaman Data Barang', 'page_heading' => 'Master Barang'])

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

      <!-- Button trigger modal -->
      <!-- <button type="button" class="btn btn-primary float-right mt-3 mx-3" data-toggle="modal" data-target="#excel_menu">
        Import
      </button> -->

      <!-- <a href="{{ route('excel.barang.export') }}" class="btn btn-success float-right mt-3 mx-3" data-toggle="tooltip" title="Export Excel">
        <i class="fas fa-fw fa-file-excel"></i>
      </a> -->

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
              <th scope="col">Tahun Pembelian</th>
              <!-- <th scope="col">Kondisi</th> -->
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($master as $commodity)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $commodity->id_barang }}</td>
              <td>{{ $commodity->kode_barang }}</td>
              <td>{{ Str::limit($commodity->nama_barang, 55, '...') }}</td>
              <td>{{ $commodity->stok }}</td>
              <!-- @if($commodity->condition === 1)
              <td>
                <span class="badge badge-pill badge-success" data-toggle="tooltip" data-placement="top" title="Baik">Baik</span>
              </td>
              @elseif($commodity->condition === 2)
              <td>
                <span class="badge badge-pill badge-warning" data-toggle="tooltip" data-placement="top" title="Kurang Baik">Kurang Baik</span>
              </td>
              @else
              <td>
                <span class="badge badge-pill badge-danger" data-toggle="tooltip" data-placement="top" title="Rusak Berat">Rusak Berat</span>
              </td>
              @endif -->
              <td class="text-center">
                <a data-id="{{ $commodity->id_barang }}" class="btn btn-sm btn-info text-white show_modal" data-toggle="modal" data-target="#show_commodity" title="Lihat Detail">
                  <i class="fas fa-fw fa-info"></i>
                </a>
                <a data-id="{{ $commodity->id_barang }}" class="btn btn-sm btn-success text-white swal-edit-button" data-toggle="modal" data-target="#edit_commodity" data-placement="top" title="Ubah data">
                  <i class="fas fa-fw fa-edit"></i>
                </a>
                <a data-id="{{ $commodity->id_barang }}" class="btn btn-sm btn-danger text-white swal-delete-button" data-toggle="tooltip" data-placement="top" title="Hapus data">
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
@include('BarangMaster.modal.show')
@include('BarangMaster.modal.create')
@include('BarangMaster.modal.edit')
@include('BarangMaster.modal.import')
@endpush

@push('js')
@include('BarangMaster._script')
@endpush