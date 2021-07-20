<!-- Modal -->
<div class="modal fade" id="edit_commodity" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal Update Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="commodity_edit">
                @csrf
                    <div class="row">
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label for="item_code_edit">ID Barang</label>
                                <input type="text" name="ID_brg" class="form-control" id="ID_brg"disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="item_code_edit">Kode Barang</label>
                                <input type="text" name="item_code_edit" class="form-control" id="item_code_edit"disabled>
                            </div>
                        </div>
      
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name_edit">Nama Barang</label>
                                <input type="text" class="form-control" id="name_edit">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="quantity_edit">Stok</label>
                                <input type="number" class="form-control" id="quantity_edit">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="price_edit">Harga</label>
                                <input type="number" class="form-control" id="price_edit">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="price_per_item_edit">Harga Satuan</label>
                                <input type="number" class="form-control" id="price_per_item_edit">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button data-id="" type="submit" class="btn btn-primary" id="swal-update-button">Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>