<?php

session_start();
error_reporting(E_ALL);

// Autoload classes from src directory
spl_autoload_register(function ($class) {
    include __DIR__ . '/../src/' . $class . '.php';
});

$cart = new CartController();

// Handle user action
if (isset($_GET) && !empty($_GET)) {
    // Security check
    $security = new Security();
    if ($security->checkSuperglobalGet()) {
        // Add and remove product
        if ("add" === $_GET["action"]) {
            $cart->addProduct($_GET["product"]);
        } elseif ("remove" === $_GET["action"]) {
            $cart->removeProduct($_GET["product"]);
        }
    }
    // Redirect the user 
    header("Location: http://" . $_SERVER['SERVER_NAME']);
}

// Render template
include('../template/view.php');
