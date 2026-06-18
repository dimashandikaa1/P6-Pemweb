<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: index.php"); exit; }
include "koneksi.php";

$id = (int) $_GET['id'];

mysqli_query($conn, "DELETE FROM pemasukan WHERE id='$id'");

header("Location: pemasukan.php");
