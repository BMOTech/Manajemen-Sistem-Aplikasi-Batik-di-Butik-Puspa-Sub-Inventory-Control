<html>
<head>
<title>Laporan</title>
<head>
</head>
<h3><button onClick="window.print();">Print</button></h3><body>

<h1 align="center"> Laporan Barang Keluar</h1>
<hr />
<br />
<table align="center" border="2" bordercolordark="#003399" >
<tr bordercolor="#000066">
<th> No </th>
<th> Nomer Barang Masuk </th>
<th> Tanggal Masuk </th>
<th> Kode Barang</th>
<th> jumlah </th>
</tr>
<tr>

 <?php $i=1;?>
 <?php foreach ($cari as $rng): ?>
 <td align="center"> <?php echo $i++;?>
<td> <?php echo $rng->no_brgkeluar ;?></td>
<td> <?php echo $rng->tgl_keluar ;?></td>
<td> <?php echo $rng->kode_brg ;?></td>
<td> <?php echo $rng->jml_brg ;?></td>

</tr>

<?php endforeach ?>
<tr>
<?php
$sum = 0;
foreach($cari as $rows){
 $sum += str_replace(",", "", $rows->jml_brg);
}?>
<td>Jumlah</td>
<td></td>
<td></td>
<td></td>

<td><?php echo $sum ;?></td>
</tr>

</table>

	</body>
</html>
