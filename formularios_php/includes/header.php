<?php
// includes/header.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistema de Ventas - PHP + PostgreSQL</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modern-css-reset/dist/reset.min.css">
<style>
body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,Noto Sans,sans-serif; background:#f6f7fb; color:#111;}
.container{max-width:1100px; margin:30px auto; background:#fff; border-radius:12px; box-shadow:0 6px 20px rgba(0,0,0,.08); overflow:hidden;}
.header{background:#1f4cff; color:#fff; padding:18px 24px;}
.header h1{margin:0; font-size:22px;}
.nav{display:flex; gap:12px; padding:12px 24px; border-bottom:1px solid #e9ecf2; background:#fafbff;}
.nav a{padding:8px 12px; border-radius:8px; text-decoration:none; color:#1f2a44; background:#eef2ff;}
.nav a:hover{background:#dbe3ff;}
.content{padding:24px;}
.table{width:100%; border-collapse:collapse; margin-top:12px;}
.table th,.table td{padding:10px 12px; border-bottom:1px solid #eceff5; text-align:left; vertical-align:top;}
.table th{background:#f4f6fd; font-weight:600;}
.btn{display:inline-block; padding:8px 12px; border-radius:8px; text-decoration:none; border:1px solid #d0d7ff; background:#eef2ff; color:#1f2a44;}
.btn:hover{background:#dbe3ff;}
.btn-primary{background:#1f4cff; color:#fff; border-color:#1f4cff;}
.btn-primary:hover{filter:brightness(0.95);}
.btn-danger{background:#ffe8ea; color:#a3161a; border-color:#ffd5d8;}
.btn-danger:hover{background:#ffd5d8;}
.form-grid{display:grid; grid-template-columns:repeat(2, minmax(0,1fr)); gap:16px;}
input, select{width:100%; padding:10px 12px; border:1px solid #dfe3ec; border-radius:8px;}
label{display:block; margin-bottom:6px; font-size:14px; color:#3a4363;}
.actions{display:flex; gap:8px; align-items:center;}
.badge{display:inline-block; padding:4px 8px; border-radius:999px; background:#ecfdf3; color:#0f5132; font-size:12px; border:1px solid #d1fae5;}
.footer{padding:12px 24px; color:#637099; font-size:13px; border-top:1px solid #e9ecf2; background:#fafbff;}
hr{border:0; border-top:1px solid #eceff5; margin:16px 0;}
.field{margin-bottom:12px;}
.small{font-size:12px; color:#6b7280;}
</style>
</head>
<body>
<div class="container">
  <div class="header"><h1>Sistema de Ventas</h1></div>
  <div class="nav">
    <a href="/index.php">Inicio</a>
    <a href="/clientes/index.php">Clientes</a>
    <a href="/productos/index.php">Productos</a>
    <a href="/usuarios/index.php">Usuarios</a>
    <a href="/ventas/index.php">Ventas</a>
  </div>
  <div class="content">
