<script>
window.onload = function () {

function getData(){
    $.get('{{ route("getChart") }}', function(res){
        // console.log(res);

        var decode = JSON.parse(res);

        console.log(decode.dataIn);

        var dataIn = [];
        var dataOut = [];

        $.each(decode.dataIn, function(id, val){
            dataIn.push({
                x : new Date(val.week),
                y : val.value
            });
        });

        $.each(decode.dataOut, function(id, val){
            dataOut.push({
                x : new Date(val.week),
                y : val.value
            });
        });


        var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Daily Kelola Barang Masuk/Keluar"
        },
        axisX: {
            valueFormatString: "DDD",
            // minimum: new Date(decode.first),
            // maximum: new Date(decode.end)
        },
        axisY: {
            title: "Harga"
        },
        legend: {
            verticalAlign: "top",
            horizontalAlign: "right",
            dockInsidePlotArea: true
        },
        toolTip: {
            shared: true
        },
        data: [{
            name: "Transaksi Masuk",
            showInLegend: true,
            legendMarkerType: "square",
            type: "line",
            color: "rgba(40,175,101,0.6)",
            markerSize: 0,
            dataPoints: dataIn
        },
        {
            name: "Transaksi Keluar",
            showInLegend: true,
            legendMarkerType: "square",
            type: "line",
            color: "rgba(0,75,141,0.7)",
            markerSize: 0,
            dataPoints: dataOut
        }]
    });
    chart.render();
        
    });
}

getData();
 
 
  
 }

    $(document).ready(function() {
        $(".show_modal").click(function() {
            let id = $(this).data("id")
            let token = $("input[name=_token]").val();

            $.ajax({
                type: "GET",
                url: "commodities/json/" + id,
                data: {
                    id: id,
                    _token: token
                },
                success: function(data) {
                    console.log(data)
                    $("#modalLabel").html(data.data.item_code)
                    $("#item_code").val(data.data.item_code)
                    $("#commodity_location_id").html(data.data.commodity_location_id)
                    $("#name").html(data.data.name)
                    $("#brand").val(data.data.brand)
                    $("#material").val(data.data.material)
                    $("#date_of_purchase").val(data.data.date_of_purchase)
                    $("#school_operational_assistance_id").html(data.data.school_operational_assistance_id)
                    $("#quantity").val(data.data.quantity)
                    $("#price").val(data.data.price)
                    $("#price_per_item").val(data.data.price_per_item)
                    $("#note").html(data.data.note)
                }
            })
        })
    })
</script>