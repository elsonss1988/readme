<?php 
session_start();
$_SESSION['etapa'] = 1;
$_SESSION['list_convidados'] = 0;

if($_SESSION['id_live'] == ""){
  header('Location: install');
}
?>