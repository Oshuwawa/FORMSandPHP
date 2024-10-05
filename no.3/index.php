<?php
declare(strict_types = 1);

// Array for available candies and their prices
$food = [
    'Kwek2x_s' => ['price' => 5],  // Replace spaces with underscores for form input
    'Isaw'  => ['price' => 5],
    'Pipino'  => ['price' => 4],
    'Kikiam'  => ['price' => 12],
];

// Function to calculate total value (price x quantity)
function get_total_value(float $price, int $quantity): float
{
    return $price * $quantity;
}

// Initialize variables for total values and change
$total_values = [];
$total_cost = 0;
$change = 0;
$error_message = "";

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Loop through each food item
    foreach ($food as $product_name => $data) {
        // Get the quantity for each food from the user input
        $quantity = isset($_POST[$product_name]) ? (int)$_POST[$product_name] : 0;

        // Calculate the total value for each food
        $total_values[$product_name] = get_total_value($data['price'], $quantity);

        // Accumulate the total cost
        $total_cost += $total_values[$product_name];
    }

    // Get the amount of cash the user entered
    $cash_given = isset($_POST['cash']) ? (float)$_POST['cash'] : 0;

    // Check if the cash is enough to cover the total cost
    if ($cash_given < $total_cost) {
        $error_message = "Insufficient cash! The total cost is ₱$total_cost, but you only provided ₱$cash_given.";
    } else {
        // Calculate the change to return
        $change = $cash_given - $total_cost;
    }
    
    // Get the current date and time
    $current_date_time = date("Y-m-d H:i:s");
}
?>
<!DOCTYPE html>
<html> 
  <head>
    <title>MENU ITEMS</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1>MENU ITEMS</h1>
    <h2>Order Form</h2>

    <form action="" method="POST">
      <table>
        <tr>
          <th>Product</th><th>Price per unit</th><th>Quantity</th><th>Total Cost</th>
        </tr>

        <!-- Display each food option with a quantity input field -->
        <?php foreach ($food as $product_name => $data) { 
          // Display the product name correctly (replace underscores with spaces)
          $display_name = str_replace('_', ' ', $product_name); 
        ?>
          <tr>
            <td><?= $display_name ?></td>
            <td>₱<?= $data['price'] ?></td>
            <td><input type="number" name="<?= $product_name ?>" min="0" value="<?= isset($_POST[$product_name]) ? (int)$_POST[$product_name] : 0 ?>"></td>
            <td>
              <!-- Display the total cost after form submission -->
              <?php if (isset($total_values[$product_name])): ?>
                ₱<?= number_format($total_values[$product_name], 2) ?>
              <?php endif; ?>
            </td>
          </tr>
        <?php } ?>
      </table>

      <!-- Cash input field for user to enter amount of cash -->
      <h2>Enter Cash Amount Here:</h2>
      <p><input type="number" step="0.01" placeholder="Enter cash amount here" name="cash" value="<?= isset($_POST['cash']) ? (float)$_POST['cash'] : 0 ?>"></p>
      
      <p><input type="submit" value="Place Order"></p>
    </form>

    <!-- Error message if cash is insufficient -->
    <?php if (!empty($error_message)): ?>
      <p style="color:red;"><?= $error_message ?></p>
    <?php endif; ?>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($error_message)): ?>
      <h2>Order Summary</h2>
      <ul>
        <?php 
        // Display each product with the calculated total cost
        foreach ($total_values as $product_name => $total_value) {
            $display_name = str_replace('_', ' ', $product_name); // Display the product name correctly
            echo "<li>$display_name: ₱" . number_format($total_value, 2) . "</li>";
        }
        ?>
      </ul>

      <h3>Total Amount: ₱<?= number_format($total_cost, 2) ?></h3>
      <h3>Cash Given: ₱<?= number_format($cash_given, 2) ?></h3>
      <h3>Change: ₱<?= number_format($change, 2) ?></h3>
      <h3>Date and Time: <?= $current_date_time ?></h3>
    <?php endif; ?>
  </body>
</html>
