<?php include '../database/config.php'; ?>
<title>Report Item</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<center>
  <h4>REPORT ITEM</h4>
  <br>
</center>

<table id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col">Item</th>
      <th scope="col">Quantity</th>
      <th scope="col">Selling Price</th>
      <th scope="col">Purchase Price</th>
      <th scope="col">Unit</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = $mysqli->query("SELECT * FROM tb_item");
    while ($data = $query->fetch_object()) {
    ?>
      <tr>
        <th scope="row"><?= $data->item_name;  ?></th>
        <td><?= $data->quantity;  ?></td>
        <td>Rp. <?= number_format($data->selling_price); ?>;-</td>
        <td>Rp. <?= number_format($data->purchase_price); ?>;-</td>
        <td><?= $data->unit_type;  ?></td>
      </tr>
    <?php } ?>
</table>
</tbody>
<?php include '../js.php'; ?>

<script type="text/javascript">
  window.print();
</script>