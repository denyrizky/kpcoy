@extends('layouts.stisla.index', ['title' => 'Admin Dashboard', 'page_heading' => 'Halaman Utama'])

@section('content')
<!-- <div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-primary">
        <i class="fas fa-columns"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Barang</h4>
        </div>
        <div class="card-body">
          {{ $commodity_count }}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-danger">
        <i class="fas fa-fw fa-check-circle"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Kondisi Baik</h4>
        </div>
        <div class="card-body">
          {{ $commodity_condition_good_count }}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-warning">
        <i class="fas fa-fw fa-exclamation-circle"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Kondisi Rusak Ringan</h4>
        </div>
        <div class="card-body">
          {{ $commodity_condition_not_good_count }}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-danger">
        <i class="fas fa-fw fa-times-circle"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Kondisi Rusak Berat</h4>
        </div>
        <div class="card-body">
          {{ $commodity_condition_heavily_damage_count }}
        </div>
      </div>
    </div>
  </div>
</div> -->
<div class="row">
  <div class="col-lg-12 col-md-12 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4>Chart Transaksi</h4>
      </div>
      <div class="card-body">
      <div id="chartContainer" style="height: 300px; width: 100%;"></div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('modal')
@include('show')
@endpush

@push('js')
@include('_script');
@endpush