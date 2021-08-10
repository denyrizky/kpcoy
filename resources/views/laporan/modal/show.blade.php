<!-- Modal -->
<div class="modal fade" id="show_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="commodity_create">
          @csrf
          <div class="row">
          <div class="col-lg-3">
              <div class="form-group">
                <label for="name">Kode TRX</label><br/>
                <h3 id="kode_trx_edit"></h3>
              </div>
            </div>

            <div class="col-lg-9">
              <div class="form-group">
                <!-- <input type="text" name="item_code" class="form-control" id="item_code_create" hidden> -->
                <label for="name">Status TRX</label><br/>
                <h3 id="stat_trx_edit"></h3>
              </div>
            </div>
          </div>

          <table class="table table-bordered" id="show_table">
            <thead>
              <tr>
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
          </div>
        </form>
      </div>
    </div>
  </div>
</div>