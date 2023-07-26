<?php


require 'assets/dp/conn.php';

$sql = "SELECT * FROM cart_items";
$result = $conn->query($sql);


if (isset($_POST['submit'])) {

    $delete_id = $_POST['delete'] ;
    $stmt = $conn->prepare('DELETE from Cart_items WHERE id = ? ') ;
    $stmt->bind_param('i',$delete_id) ;
    $stmt->execute() ;

    header("Location: cart.php");

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Cards</title>
    <link rel="stylesheet" href="assets/styles/bootstrap.min.css">

</head>

<?php require 'header.php'; ?>


<div class="container">
    <table class="table table-striped table-bordered mt-5">
        <thead>

        <th>Id</th>
        <th>Name</th>
        <th>Price</th>
        <th>Count</th>
        <th>Discount</th>
        <th>Pic</th>
        <th>Delete</th>

        </thead>

        <?php

        $total_amount = 0;
        $total_discount = 0;
        $total_after_discount = 0;

        if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) { ?>

            <tbody>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row["title"] ?></td>
                <td><?= '$ ' . $row["price"]; ?></td>
                <td><?= $row["count"] ?></td>
                <td><?php $discountAmount = ($row["price"] * $row["discount"] / 100);
                    echo '$ ' . $discountAmount;
                    $total_discount += (double)$discountAmount; ?></td>
                <td><img src="<?= $row["thumbnail"] ?>" alt="thumbnail" width="60"></td>
                <td>
                    <form action="cart.php" method="post">
                        <input type="hidden" name="delete" value="<?= $row["id"] ?>">
                        <button class="btn btn-danger" type="submit" name="submit">Delete</button>
                    </form>
                </td>
            </tr>
            </tbody>


            <?php
            $total_amount += $row["price"] * $row["count"];
            $total_after_discount = $total_amount - $total_discount;

        } ?>

        <tr>
            <td colspan="2"><?= 'Total Amount : $' . $total_amount ?></td>
            <td colspan="2"><?= 'Total Discount : $' . $total_discount ?></td>
            <td colspan="3"><?= 'Total After Discount : $' . $total_after_discount ?></td>
        </tr>

    </table>

    <?php

    } else {

        echo "0 results";
        $conn->close();

    }


    ?>

</div>
</body>
</html>
