<!-- Modal -->
<div class="modal fade" id="commodity_create_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="commodity_create">
          @csrf
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="item_code">Kode Barang</label>
                <input type="text" name="item_code" class="form-control" id="item_code_create">
              </div>
            </div>


          
            <div class="col-lg-6">
              <div class="form-group">
                <label for="name">Nama Barang</label>
                <input type="text" class="form-control" id="name_create">
              </div>
            </div>
          </div>
            <!-- <div class="col-lg-4">
              <div class="form-group">
                <label for="brand">Merek</label>
                <input type="text" class="form-control" id="brand_create">
              </div>
            </div> -->
          <hr>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="date_of_purchase">Tahun Pembelian</label>
                <input type="date" class="form-control" id="date_of_purchase_create">
              </div>
            </div>
          </div>

          <!-- <div class="row">
            <div class="col-lg-5">
              <div class="form-group">
                <label for="material">Bahan</label>
                <input type="text" class="form-control" id="material_create">
              </div>
            </div> -->

           
          <hr>
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label for="quantity">Kuantitas</label>
                <input type="number" class="form-control" id="quantity_create">
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" class="form-control" id="price_create">
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label for="price_per_item">Harga Satuan</label>
                <input type="number" class="form-control" id="price_per_item_create">
              </div>
            </div>
          </div>

          <!-- <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="note">Keterangan</label>
                <textarea class="form-control" id="note_create" rows="3"></textarea>
              </div>
            </div>
          </div> -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>