<?php
$action = $_POST['action'];

session_start();

if($action=='specialist'){
    $_SESSION['ROLE']=$action;
    echo $_SESSION['ROLE'];
}
if($action=='parent'){
    $_SESSION['ROLE']=$action;
    echo $_SESSION['ROLE'];
}