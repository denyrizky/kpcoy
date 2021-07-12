<script>
    $(document).ready(function() {
        $(".show_modal").click(function() {
            let id = $(this).data("id")
            let token = $("input[name=_token]").val();

            // alert(id);

            $.ajax({
                type: "GET",
                url: "BarangMaster/show/" + id,
                // data: {
               
                //     id: id,
                //     _token: token
                // },
                success: function(data) {
                    console.log(data);
                    $("#modalLabel").html(data.data.kode_barang)
                    $("#item_code").val(data.data.kode_barang)
                    $("#id_barang_edit").val(data.data.id_barang)
                   // $("#commodity_location_id").html(data.data.commodity_location_id)
                    $("#name").html(data.data.nama_barang)
                    // $("#brand").val(data.data.brand)
                    // $("#material").val(data.data.material)
                    $("#date_of_purchase").val(data.data.created_at)
                    // $("#school_operational_assistance_id").html(data.data.school_operational_assistance_id)
                    $("#date_of_update").val(data.data.updated_at)
                    $("#quantity").val(data.data.stok)
                    $("#price").val(data.data.harga)
                    $("#price_per_item").val(data.data.harga_satuan)
                    // $("#note").html(data.data.note)
                }
            })
        })

        $("form[name='commodity_create']").submit(function(e) {
            e.preventDefault();
            let token = $("input[name=_token]").val();

            $.ajax({
                type: "POST",
                url: "BarangMaster/json",
                data: {
                    _token: token,
                    kode_barang: $("#item_code_create").val(),
                    nama_barang: $("#name_create").val(),
                    stok: $("#quantity_create").val(),
                    harga: $("#price_create").val(),
                    harga_satuan: $("#price_per_item_create").val(),
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

            // Injecting an id with relevant data on click for updating on #swal-update-button
            $("#swal-update-button").attr("data-id", id);

            $.ajax({
                url: "BarangMaster/update/" + id + "/edit",
                type: "GET",
                data: {
                    id: id,
                    _token: token
                },
                success: function(data) {
                    $("#id_barang_edit").val(data.data.id_barang)
                    $("#item_code_edit").val(data.data.kode_barang)
                    $("#name_edit").val(data.data.nama_barang)
                    $("#quantity_edit").val(data.data.stok)
                    $("#price_edit").val(data.data.harga)
                    $("#price_per_item_edit").val(data.data.harga_satuan)

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
                url: "BarangMaster/ubah/" + id,
                type: "PUT",
                data: {
                    _token: token,

                    kode_barang: $("#item_code_edit").val(),
                    nama_barang: $("#name_edit").val(),
                    stok: $("#quantity_edit").val(),
                    harga: $("#price_edit").val(),
                    harga_satuan: $("#price_per_item_edit").val(),
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
                        url: "BarangMaster/delete/" + id,
                        type: "DELETE",
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