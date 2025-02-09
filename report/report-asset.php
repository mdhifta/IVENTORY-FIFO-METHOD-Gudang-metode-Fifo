<?php include '../database/config.php'; ?>
<title>Report Asset</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<center>
  <h4>REPORT ASSET <br> ON <?= $_POST['start'] ?> - <?= $_POST['end']  ?></h4>
  <br>
</center>

<table id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="5%"><strong>No</strong></td>
      <td width="15%"><strong>Item</strong></td>
      <td width="10%"><strong>Stock</strong></td>
      <td width="10%"><strong>Purchase Price</strong></td>
      <td width="10%"><strong>Selling Price</strong></td>
    </tr>
  </thead>
  <tbody>
    <?php
    $start = $_POST['start'];
    $end = $_POST['end'];
    $no = 0;

    $query = $mysqli->query("SELECT tbii.*, tbp.purchase_date, tbi.item_name, tbi.unit_type
    FROM tb_item_in as tbii 
    JOIN tb_purchase as tbp ON tbp.item_in_id=tbii.id 
    JOIN tb_item as tbi ON tbi.id=tbii.item_id
    WHERE tbp.purchase_date BETWEEN '$start' AND '$end' 
    AND tbii.total_in!=0 
    ORDER BY tbii.id");

    while ($data = $query->fetch_object()) {
    ?>
      <tr>
        <th scope="row"><?= $no += 1;  ?></th>
        <td><?= $data->item_name;  ?></td>
        <td><?= $data->total_in; ?>/<?= $data->unit_type; ?></td>
        <td><?= number_format($data->price); ?>/<?= $data->unit_type; ?></td>
        <td><?= number_format($data->price + 1500); ?>/<?= $data->unit_type; ?></td>
      </tr>
    <?php } ?>
</table>
</tbody>
<?php include '../js.php'; ?>

<script type="text/javascript">
  window.print();
</script>