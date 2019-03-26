<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 3/25/2019
 * Time: 3:55 PM
 */

    include_once '../config/database.php';

    $database = new Database();
    $conn = $database->getConnection();
    $username = 'jakeFasil';
    $stmt = $conn->prepare('SELECT * FROM USERS WHERE UserName= ?');
    $stmt->execute([$username]);

    echo $stmt->rowCount();