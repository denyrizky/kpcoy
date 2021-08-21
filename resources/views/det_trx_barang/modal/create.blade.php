<!-- Modal -->
<div class="modal fade" id="commodity_create_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal Kelola Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="commodity_create">
          @csrf
          <div class="row">

            <div class="col-lg-9">
              <div class="form-group">
                <!-- <input type="text" name="item_code" class="form-control" id="item_code_create" hidden> -->
                <label for="name">Status TRX</label>
                <select name="stat_trx" name="stat_trx" id="stat_trx" class="form-control">
                  <option value="1">Barang Masuk</option>
                  <option value="2">Barang Keluar</option>
                </select>
              </div>
            </div>
          </div>


          <hr>
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label for="quantity">Pilih Barang</label> <br/>
                <select name="" class="form-control" id="pilih_barang">
                  <option value="">[ Silahkan Pilih Barang ]</option>
                  @foreach($show as $barang)
                
                  <option value="{{ $barang->id_barang }}~{{ $barang->kode_barang }}~{{ $barang->nama_barang }}~{{ $barang->harga_satuan }}~{{ $barang->stok }}">{{ $barang->nama_barang }} [Stock: {{ $barang->stok }}] </option>
                  
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label for="price">Harga Satuan</label>
                <input type="number" class="form-control" id="harga" Readonly>
              </div>
            </div>

            <div class="col-lg-2">
              <div class="form-group">
                <label for="price_per_item">Qty</label>
                <input type="number" class="form-control" id="qty">
              </div>
            </div>
            
            <div class="col-lg-3">
              <label for="">&nbsp;</label>
              <button class="form-control btn btn-success" type="button" id="tambah_tombol"><i class="fa fa-plus"></i> Tambah</button>
            </div>
          </div>

          <hr>

          <table class="table table-bordered" id="badan_table">
            <thead>
              <tr>
                <th>#</th>
                <th>Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>


          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>