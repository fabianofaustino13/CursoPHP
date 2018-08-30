<?php

session_start();
session_destroy();

$home = "/cursoPHP/loja/";
header("location: $home");