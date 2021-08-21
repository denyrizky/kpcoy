<html>
<head>
<?php $kosong = ' &nbsp'; ?>
    <title><?=  $kosong?></title>
</head>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>
<body>
<div class="form-group">
    <h3><p align="center"><b>Laporan Kelola Barang</b></p></h3>
<table class="static" align="center" rules="all" border="1px" style="font-size:15px; width: 95%;">

        <thead class="table-dark">
		<tr>
			<td>kode trx</td>
			<td>Nama barang</td>
      <td>Harga</td>
      <td>Kuantitas</td>
      <td>Jumlah</td>
		</tr>
        </thead>

<tbody class="table">
  <?php $lastTrxID = ''; ?>
  <?php $lastTotal = ''; ?>
            @foreach ($cetak as $key => $item)
            <?php
              $trxID = $item->kode_trx;
              $total = $item->harga_total;
              if($trxID == $lastTrxID || $total == $lastTotal){
                $trxID = '';
                $total = '';
                
              }

            ?>
            <tr>
                <td><?= $trxID ?></td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->harga }}</td>
                <td>{{ $item->qty }}</td>
                <td><?=  $total?></td>
</tr>
<?php
$lastTrxID = $trxID;
?>
                @endforeach
        </tbody>
</table>


<script>
		window.print();
</script>

</body>
</html>