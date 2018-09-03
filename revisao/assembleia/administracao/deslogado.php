<?php

session_start();

$homeAssembleia = "/cursoPHP/revisao/assembleia/assembleia/";

if (isset($_SESSION['isLogado']) && $_SESSION['isLogado']) {
    header("location: $homeAssembleia");
}