<script>
    
    $(document).ready(function() {
        $(".show_modal").click(function() {
            let id = $(this).data("id")
            let token = $("input[name=_token]").val();

            // alert(id);

            $.ajax({
                method:"GET",
                url: "BarangMaster/" + id,
                // data: {
               
                //     id: id,
                //     _token: token
                // },
                success: function(data) {
                    console.log(data);
                    $("#modalLabel").html(data.data.kode_barang)
                    $("#item_code").val(data.data.kode_barang)
                    $("#name").html(data.data.nama_barang)
                    $("#date_of_purchase").val(data.data.created_at)
                    $("#date_of_update").val(data.data.updated_at)
                    $("#quantity").val(data.data.stok)
                    $("#price").val(data.data.harga)
                    $("#price_per_item").val(data.data.harga_satuan)
                    $("#merk").html(data.data.merk)
                }
            })
        })

        $("form[name='commodity_create']").submit(function(e) {
            e.preventDefault();
            let token = $("input[name=_token]").val();
            let nameCreate = document.forms["commodity_create"]["name_create"].value;
            let itemCreate = document.forms["commodity_create"]["price_per_item_create"].value;
            let merk = document.forms["commodity_create"]["merk_create"].value;
                if (nameCreate == '' || itemCreate == '' || merk=='') {
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
                url: "BarangMaster/",
                data: {
                    _token: token,
                    kode_barang: $("#item_code_create").val(),
                    nama_barang: $("#name_create").val(),
                    
                    harga: $("#price_create").val(),
                    harga_satuan: $("#price_per_item_create").val(),
                    merk: $("#merk_create").val(),
                },
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
        })

        $(".swal-edit-button").click(function() {
            let id = $(this).data("id");
            let token = $("input[name=_token]").val();
            let name = $("#name_edit").val();
            // Injecting an id with relevant data on click for updating on #swal-update-button
            $("#swal-update-button").attr("data-id", id);

            $.ajax({
                url: "BarangMaster/" + id + "/edit",
                method:"GET",
                data: {
                    id: id,
                    _token: token
                },
                success: function(data) {
                    console.log(data);
                    $("#item_code_edit").val(data.data.kode_barang)
                    $("#name_edit").val(data.data.nama_barang)
                    $("#quantity_edit").val(data.data.stok)
                    $("#price_edit").val(data.data.harga)
                    $("#price_per_item_edit").val(data.data.harga_satuan)
                    $("#merk_edit").val(data.data.merk)
                },
                error: function(data) {
                    Swal.fire("Gagal!", "Tidak dapat melihat info kategori.", "warning");
                }
            });
        });

        $("#swal-update-button").click(function(e) {
            e.preventDefault();
            // Get id injected by .swal-edit-button
            let id = $("#swal-update-button").attr("data-id");
            let token = $("input[name=_token]").val();
            
            let name = $("#name_edit").val();
            let description = $("#description_edit").val();

            
            $.ajax({

                url: "BarangMaster/" + id,
                method:"PUT",
                data: {
                    _token: token,

                    kode_barang: $("#item_code_edit").val(),
                    nama_barang: $("#name_edit").val(),
                    stok: $("#quantity_edit").val(),
                    harga: $("#price_edit").val(),
                    harga_satuan: $("#price_per_item_edit").val(),
                    merk: $("merk_edit").val(),
                },
                success: function(data) {
                    console.log(data);
                    Swal.fire({
                        title: "Berhasil",
                        text: "Data berhasil diubah.",
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
                    }, 800)
                },
                error: function(data) {
                    Swal.fire("Gagal!", "Tidak dapat mengubah data.", "warning");
                }
            });
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
                        url: "BarangMaster/" + id,
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

    })

</script>