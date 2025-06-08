<?php
session_start();
$employee_id = $_SESSION['employee_id'];

include("../../database/config.php");

#data post
$data_id = array();
$i = 0;

foreach ($_SESSION['item_id'] as $row => $item_id) {
  $quantity = $_SESSION['quantity'][$row];
  $price = $_SESSION['price'][$row];

  $query = $mysqli->query("SELECT * FROM tb_item_in as tbii 
  JOIN tb_purchase as tbp ON tbp.item_in_id=tbii.id 
  WHERE tbii.item_id='$item_id' AND tbii.total_in!=0 
  ORDER BY tbii.id ASC");

  while ($data = $query->fetch_object()) {
    $data_id[$i += 1] = $data->id;
  }

  for ($j = 1; $j <= $i; $j++) {
    $item_in = $mysqli->query("SELECT tbii.total_in as total_in, tbii.price as price 
    FROM tb_item_in as tbii 
    JOIN tb_purchase as tbp ON tbp.item_in_id=tbii.id 
    WHERE tbii.id=$data_id[$j]");

    $data = $item_in->fetch_object();
    $selling_price = $price;

    if ($quantity >= $data->total_in) {
      if ($mysqli->query("UPDATE tb_item_in SET total_in=0, history=history+$data->total_in WHERE id=$data_id[$j]")) {
        if ($mysqli->query("UPDATE tb_item SET quantity=quantity-$data->total_in, purchase_price='$data->price', selling_price='$selling_price' WHERE id='$item_id'")) {

          $temporary_total = $quantity - $data->total_in;
          $quantity_calculate = $quantity - $temporary_total;
          $total = ($price) * $quantity_calculate;

          if ($mysqli->query("INSERT INTO tb_item_out(item_id, total, price, date_out)  VALUES('$item_id', '$data->total_in', '$total', NOW())")) {

            $item_out_id = $mysqli->insert_id;

            if ($mysqli->query("INSERT INTO tb_selling(item_out_id, employee_id, selling_date) VALUES('$item_out_id', '$employee_id', NOW())")) {

              $quantity = $temporary_total;

              if ($quantity == 0) {
                $success = 1;
                break;
              }
            } else {
              echo "Failed to inset tb_selling (1)";
            }
          } else {
            echo "Failed to insert tb_item_out (1)";
          }
        } else {
          echo "Failed to update tb_item_in (1)";
        }
      } else {
        echo "Failed to update tb_item (1)";
      }
    } else {
      if ($mysqli->query("UPDATE tb_item SET quantity=quantity-$quantity, purchase_price='$data->price', selling_price='$selling_price' WHERE id='$item_id'")) {

        if ($mysqli->query("UPDATE tb_item_in SET total_in=total_in-$quantity, history=history+$quantity WHERE id=$data_id[$j]")) {

          $total = ($price) * $quantity;

          if ($mysqli->query("INSERT INTO tb_item_out(item_id, total, price, date_out) VALUES('$item_id', '$quantity', '$total', NOW())")) {
            $item_out_id = $mysqli->insert_id;
            if ($mysqli->query("INSERT INTO tb_selling(item_out_id, employee_id, selling_date) VALUES('$item_out_id', '$employee_id', NOW())")) {
              $cek = 1;
              break;
            } else {
              echo "Failed to inset tb_selling (2)";
            }
          } else {
            echo "Failed to insert tb_item_out (2)";
          }
        } else {
          echo "Failed to update tb_item_in (2)";
        }
      } else {
        echo "Failed to update tb_item (2)";
      }
    }
  }
  #end Proses
}
?>

<?php include("css.php"); ?>
<title>Struk</title>
<img src="../../vendor/images/favicon.png" alt="" style="width:100px;margin-left:5%;">

<h1 style="float:right;margin-right:30%;">STORE PAYMENT & PURCHASE RECEIPT<br> Jl. Address No. 245<br>
  <p>Purchase on date/time <?= date('d-M-Y / h:i A') ?></p>
</h1>

<!-- jarak -->
<table id="example2" class="table table-bordered table-hover" style="margin-top:2%;border:none;">
  <thead>
    <tr>
      <th>No</th>
      <th>Item</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Total Payment</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $total_payment = 0;
    ?>
    <?php if (isset($_SESSION['item_id'])): ?>
      <?php foreach ($_SESSION['item_id'] as $row => $item_id): ?>
        <?php
        $item = $mysqli->query("SELECT item_name, selling_price FROM tb_item WHERE id='$item_id'")->fetch_object();
        $sub_total = $_SESSION['price'][$row] * $_SESSION['quantity'][$row];
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $item->item_name; ?></td>
          <td><?= $_SESSION['quantity'][$row]; ?>
          </td>
          <td><?= number_format($_SESSION['price'][$row]); ?>,-</td>
          <td><?= number_format($sub_total); ?>,-</td>
        </tr>
        <?php $total_payment = $total_payment + $sub_total ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
  <tbody>
    <td></td>
    <td></td>
    <td></td>
    <td><b>TOTAL: </b></td>
    <td><b><?= number_format($total_payment); ?></b></td>
  </tbody>
</table>
<script type="text/javascript">
  window.print();
</script>

<?php
if ($cek == 1) {
  $_SESSION['item_id'] = array();
  $_SESSION['quantity'] = array();
  $_SESSION['price'] = array();
} else {
  echo "error move";
}
?>