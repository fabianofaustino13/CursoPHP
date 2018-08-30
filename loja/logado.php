<?php

session_start();

$home = "/cursoPHP/loja/";
if (!isset($_SESSION['isLogado']) || !$_SESSION['isLogado']) {
    header("location: $home");
}