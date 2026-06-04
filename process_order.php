<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    header('Location: index.html');
    exit();
}

header('Location: checkout.html');
exit();
?>