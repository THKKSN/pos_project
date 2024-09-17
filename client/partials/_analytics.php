<?php
//1. Customers
$query = "SELECT COUNT(*) FROM `table_top` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($customers);
$stmt->fetch();
$stmt->close();

//2. Orders
$query = "SELECT COUNT(*) FROM `order` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($orders);
$stmt->fetch();
$stmt->close();

//3. Orders
$query = "SELECT COUNT(*) FROM `menu_item` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($products);
$stmt->fetch();
$stmt->close();

//4.Sales
$query = "SELECT SUM(content) FROM `transaction`";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($sales);
$stmt->fetch();
$stmt->close();
