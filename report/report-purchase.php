<?php include '../database/config.php'; ?>
<title>Report Purchase</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<center>
  <h4>PURCHASE ITEMS REPORT <br> ON <?= $_POST['start'] ?> - <?= $_POST['end']  ?></h4>
  <br>
</center>

<table id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col">Item</th>
      <th scope="col">Quantity</th>
      <th scope="col">Out</th>
      <th scope="col">Supplier</th>
      <th scope="col">Purchase Price</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $start = $_POST['start'];
    $end = $_POST['end'];

    $query = $mysqli->query("SELECT tbii.*, tbp.purchase_date, tbi.item_name, tbi.unit_type, tbs.name as supplier_name 
    FROM tb_item_in as tbii 
    JOIN tb_purchase as tbp ON tbp.item_in_id=tbii.id 
    JOIN tb_item as tbi ON tbi.id=tbii.item_id 
    JOIN tb_supplier as tbs ON tbs.id=tbp.supplier_id 
    WHERE tbp.purchase_date BETWEEN '$start' AND '$end' 
    ORDER BY tbii.id");

    while ($data = $query->fetch_object()) {
    ?>
      <tr>
        <th scope="row"><?= $data->item_name;  ?></th>
        <td><?= $data->total_in;  ?></td>
        <td><?= $data->history;  ?></td>
        <td><?= $data->supplier_name;  ?></td>
        <td><?= number_format($data->price); ?>/<?= $data->unit_type; ?></td>
        <td><?= date("Y-m-d", strtotime($data->purchase_date));  ?></td>
      </tr>
    <?php } ?>
</table>
</tbody>

<?php include '../js.php'; ?>

<script type="text/javascript">
  window.print();
</script>