<?php include '../database/config.php'; ?>
<title>Sales Report</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<center>
  <h4>SALES ITEM REPORT <br> ON <?= $_POST['start'] ?> - <?= $_POST['end']  ?></h4>
  <br>
</center>

<table id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="20%"><strong>Item</strong></td>
      <td width="10%"><strong>Quantity</strong></td>
      <td width="10%"><strong>Transaction Date</strong></td>
      <td width="10%"><strong>Total Payment</strong></td>
      <td width="20%"><strong>Profit</strong></td>
      <td width="20%"><strong>Employee</strong></td>
    </tr>
  </thead>
  <tbody>
    <?php
    $start = $_POST['start'];
    $end = $_POST['end'];

    $query = $mysqli->query("SELECT tbi.item_name, tbi.unit_type, tbio.*, tbs.selling_date, tbe.name as employee_name 
    FROM tb_item as tbi 
    JOIN tb_item_out as tbio ON tbio.item_id=tbi.id 
    JOIN tb_selling as tbs ON tbs.item_out_id=tbio.id 
    JOIN tb_employees as tbe ON tbe.id=tbs.employee_id 
    WHERE tbs.selling_date BETWEEN '$start' AND '$end' 
    ORDER BY tbio.id DESC");

    while ($data = $query->fetch_object()) {
      ?>
      <tr>
        <th scope="row"><?= $data->item_name;  ?></th>
        <td><?= $data->total;  ?>/<?= $data->unit_type; ?></td>
        <td><?= date("Y-m-d", strtotime($data->date_out));  ?></td>
        <td><?= number_format($data->total);  ?>;-</td>
        <td><?= number_format($data->total*1500);  ?>;-</td>
        <td><?= $data->employee_name;  ?></td>
      </tr>
    <?php } ?>
  </table>
</tbody>
<?php include '../js.php'; ?>

<script type="text/javascript">
  window.print();
</script>
