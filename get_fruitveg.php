<?php

include('config.php');

$config->prepare("SELECT * FROM products LIMIT 10");

$stmt->execute();

$fruitveg = $stmt->get_result();