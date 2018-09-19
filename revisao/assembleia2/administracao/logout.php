<?php

session_start();
session_destroy();

$home = "/cursoPHP/revisao/assembleia/";
header("location: $home");