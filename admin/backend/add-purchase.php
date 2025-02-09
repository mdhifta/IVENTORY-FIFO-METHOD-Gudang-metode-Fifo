<?php
session_start();
include("../../database/config.php");
$supplier_id = $_SESSION['supplier_id'];
?>

<?php include("css.php"); ?>
<title>Struk</title>
<img src="../../vendor/images/favicon.png" alt="" style="width:100px;margin-left:5%;">
<?php
$supplier = $mysqli->query("SELECT * FROM tb_supplier WHERE id='$supplier_id'")->fetch_object();
?>
<h1 style="float:right;margin-right:30%;">STORE PAYMENT & PURCHASE RECEIPT<br> Jl. Address No. 245<br>
  <p>Purchase on date/time <?= date('d-M-Y / h:i A') ?> <br>Supplier - <?= $supplier->name; ?></p>
</h1>

<!-- jarak -->
<table id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>No</th>
      <th>Item</th>
      <th>Supplier</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Total Payment</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    $total_payment = 0; ?>
    <?php $supplier = $mysqli->query("SELECT * FROM tb_supplier WHERE id=" . $_SESSION['supplier_id'])->fetch_assoc(); ?>

    <?php if (isset($_SESSION['item_id'])): ?>
      <?php foreach ($_SESSION['item_id'] as $num_array => $item_id): ?>
        <?php
        $item = $mysqli->query("SELECT item_name FROM tb_item WHERE id='$item_id'")->fetch_assoc();
        $sub_price = $_SESSION['price'][$num_array] * $_SESSION['quantity'][$num_array];
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $item['item_name']; ?></td>
          <td><?= $supplier['name']; ?></td>
          <td style="font-size:20px;"><?= $_SESSION['quantity'][$num_array]; ?>
          </td>
          <td><?= number_format($_SESSION['price'][$num_array]); ?>,-</td>
          <td><?= number_format($sub_price); ?>,-</td>
        </tr>
        <?php $total_payment = $total_payment + $sub_price; ?>
      <?php endforeach; ?>
    <?php endif; ?>

  </tbody>
  <tbody>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><b>TOTAL PAYMENT : </b></td>
    <td><b><?= number_format($total_payment); ?>;-</b></td>
  </tbody>
</table>

<script type="text/javascript">
  window.print();
</script>

<?php
foreach ($_SESSION['item_id'] as $num_array => $item_id) {
  $quantity = $_SESSION['quantity'][$num_array];
  $price = $_SESSION['price'][$num_array];

  if ($mysqli->query("INSERT INTO tb_item_in(item_id, total_in, history, price, date_in) VALUES('$item_id', $quantity, '0', $price, NOW())")) {
    $item_in_id = $mysqli->insert_id;
    if ($mysqli->query("INSERT INTO tb_purchase(item_in_id, supplier_id, purchase_total, purchase_date) VALUES('$item_in_id', $supplier_id, $quantity, NOW())")) {
      if ($mysqli->query("UPDATE tb_item SET quantity=quantity+$quantity WHERE id=$item_id")) {
        $success = 1;
        unset($_SESSION['item_id'][$num_array]);
        unset($_SESSION['quantity'][$num_array]);
        unset($_SESSION['price'][$num_array]);
      }
    } else {
      echo "failed input to database";
      $success = 2;
    }
  } else {
    echo "query error";
    $success = 0;
  }
}
?>