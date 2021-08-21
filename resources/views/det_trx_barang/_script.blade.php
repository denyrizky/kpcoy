<script>

    $(function(){

        $('#pilih_barang').select2();

        $('#pilih_barang').on('change', function(){
            // $('#harga').val('');
            $('#qty').val('');
        });

        $(document).on('click', '.show_modal', function(){

            let id = $(this).data('id');
            let kode = $(this).data('kode');
            let status = $(this).data('status');

            let stat = "";

            if(status == 1){
                stat = 'Barang Masuk';
            }else{
                stat = 'Barang Keluar';
            }

            $('#kode_trx_edit').text(kode);
            $('#stat_trx_edit').text(stat);

            let link = 'KelolaBarang/getDetail/'+id;

            $.get(link, function(res){
                // console.log(res);
                let obj = JSON.parse(res);
                console.log(obj);

                let table = $('#show_table>tbody');
                table.html('');

                $.each(obj, function(i, val){
                    console.log(val.kode_barang);

                    let jmlh = parseFloat(val.harga) * parseFloat(val.qty);

                    let str = '<tr>'+
                    '<td>['+val.kode_barang+'] '+val.nama_barang+'</td>'+
                    '<td>'+val.harga+'</td>'+
                    '<td>'+val.qty+'</td>'+
                    '<td>'+jmlh+'</td>'
                    +'</tr>';

                    table.append(str);

                });

                $('#show_modal').modal('show');
            });

        });


        $("form[name='commodity_create']").submit(function(e) {
            e.preventDefault();
            let token = $("input[name=_token]").val();
            let itemCreate = $(this).data('qty');

            let value = $(this).val();

                let ledakan = value.split('~');
                // alert(ledakan);
                let stpk = value[4];
                if (itemCreate < stpk ) {
                     Swal.fire({
                        title: "Gagal",
                        text: "Inputan Harus Di isi.",
                        icon: "warning",
                        timerProgressBar: true,
                        showConfirmButton: true
                     });
                return false;
                }

            $.ajax({
                method:"POST",
                url: "KelolaBarang/simpan",
                data: $("form[name='commodity_create']").serializeArray(),
                success: function(data) {
                    Swal.fire({
                        title: "Berhasil",
                        text: "Data berhasil ditambahkan.",
                        icon: "success",
                        timerProgressBar: true,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                            timerInterval = setInterval(() => {
                                const content = Swal.getContent();
                                if (content) {
                                    const b = content.querySelector("b");
                                    if (b) {
                                        b.textContent = Swal.getTimerLeft();
                                    }
                                }
                            }, 100);
                        },
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 500)
                },
                error: function(data) {
                    console.log('gagal');
                    console.log(data);
                }
            })
        });

        $(document).on('click','.removeBarang', function(){
            let row = $(this).attr('dataID');
            // alert(row);
            $('.'+row).remove();
        });

        $('#pilih_barang').on('change', function(){

            let value = $(this).val();
            // alert(value);

            if(value == ''){
                $('#harga').val('');
            }else{

                let ledakan = value.split('~');
                // alert(ledakan);
                let id = ledakan[0];
                let kode = ledakan[1];
                let nama = ledakan[2];
                let harga = ledakan[3];

                // alert(ledakan);

                $('#harga').val(harga);

            }

        });

        $('#stat_trx').on('change',function(){
            $('#badan_table>tbody').html('');
        });

        $('#tambah_tombol').click(function(e){
            e.preventDefault();
            // let id = $('#')
            // let kode_trx = $('#kode_trx').val();
            // let stat_trx = $('#stat_trx').val();
            let pilih_barang = $('#pilih_barang').val();
            let harga = $('#harga').val();
            let qty = $('#qty').val();

            if(parseFloat(qty) < 0 || parseFloat(qty) == 0){
                return false;
            }
            // alert(pilih_barang);

            if(pilih_barang == ''){
                return false;
            }else{

                let ledakan = pilih_barang.split('~');
                // alert(ledakan);
                let id = ledakan[0];
                let kode = ledakan[1];
                let nama = ledakan[2];
                let harga = ledakan[3];
                let stok = ledakan[4];

                let table = $('#badan_table>tbody');

                if($('#stat_trx').val() == '2'){
                    if(stok <= 0){
                        Swal.fire({
                        title: "Gagal",
                        text: "Stok Sudah Habis.",
                        icon: "warning",
                        timerProgressBar: true,
                        showConfirmButton: true
                     });
                        return false;
                    }
                    if(parseFloat(stok) < parseFloat(qty)){
                        
                        return false;
                    }
                }
                

                if($('.barang'+id).length > 0){}else{

                    let jmlh = parseFloat(harga) * parseFloat(qty);

                    let str = '<tr class="barang'+id+'">'+
                    '<td><input type="hidden" name="idbarang[]" value="'+id+'"><button type="button" class="btn btn-danger btn-small removeBarang" dataID="barang'+id+'"><i class="fa fa-trash"></i></button></td>'+
                    '<td>['+kode+'] '+nama+'</td>'+
                    '<td><input type="hidden" name="hargaBarang[]" value="'+harga+'">'+harga+'</td>'+
                    '<td><input type="hidden" name="qtyBarang[]" value="'+qty+'">'+qty+'</td>'+
                    '<td><input type="hidden" name="jmlhHarga[]" value="'+jmlh+'">'+jmlh+'</td>'
                    +'</tr>';

                    table.append(str);

                }

            }

        });
        $(".swal-delete-button").click(function() {
            Swal.fire({
                title: "Hapus?",
                text: "Data tidak akan bisa dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal"
            }).then(result => {
                if (result.value) {
                    let id = $(this).data("id");
                    let token = $("input[name=_token]").val();
                    $.ajax({
                        url: "det_trx_barang/" + id,
                        method:"DELETE",
                        data: {
                            id: id,
                            _token: token
                        },
                        success: function(data) {
                            Swal.fire({
                                title: "Berhasil",
                                text: "Data berhasil dihapus.",
                                icon: "success",
                                timerProgressBar: true,
                                onBeforeOpen: () => {
                                    Swal.showLoading();
                                    timerInterval = setInterval(() => {
                                        const content = Swal.getContent();
                                        if (content) {
                                            const b = content.querySelector("b");
                                            if (b) {
                                                b.textContent = Swal.getTimerLeft();
                                            }
                                        }
                                    }, 100);
                                },
                                showConfirmButton: false
                            });

                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        },
                        error: function(data) {
                            Swal.fire("Gagal!", "Data gagal dihapus.", "warning");
                        }
                    });
                }
            });
        });
    });

</script>