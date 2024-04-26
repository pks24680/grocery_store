<?php

include('config.php');

$config->prepare("SELECT * FROM products LIMIT 10");

$stmt->execute();

$home = $stmt->get_result();