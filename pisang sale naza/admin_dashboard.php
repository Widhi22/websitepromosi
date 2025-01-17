<?php
session_start();

if(!isset($_SESSION['admin_id'])){
   header('location: admin_login.php');
   exit();
}

$db_name = 'mysql:host=localhost;dbname=pisang_sale';
$username = 'root';
$password = '';

$conn = new PDO($db_name, $username, $password);

// Ambil semua pesanan
$select_orders = $conn->prepare("SELECT * FROM `order`");
$select_orders->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard Admin</title>
   <link rel="stylesheet" href="css/style.css">
   <style>
      /* Gaya Umum */
      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background: #f5f5f5;
      }

      h1 {
         text-align: center;
         padding: 20px;
         margin: 0;
         background: linear-gradient(135deg, #6e8efb, #a777e3);
         color: #fff;
         font-size: 32px;
      }

      .btn {
         display: inline-block;
         padding: 10px 20px;
         background: #6e8efb;
         color: #fff;
         text-decoration: none;
         border-radius: 5px;
         transition: 0.3s;
         font-size: 14px;
         font-weight: bold;
         margin: 10px 0;
         text-align: center;
      }

      .btn:hover {
         background: #5a75d8;
      }

      /* Gaya untuk Tabel */
      table {
         margin: 20px auto;
         width: 90%;
         border-collapse: collapse;
         background: #fff;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      }

      th, td {
         padding: 15px;
         text-align: left;
         border: 1px solid #ddd;
      }

      th {
         background: #6e8efb;
         color: #fff;
         font-weight: bold;
      }

      tr:nth-child(even) {
         background: #f9f9f9;
      }

      tr:hover {
         background: #f1f1f1;
      }

      /* Gaya untuk Header dan Tombol Logout */
      .header {
         display: flex;
         justify-content: space-between;
         align-items: center;
         padding: 10px 20px;
         background: #6e8efb;
         color: #fff;
      }

      .header h1 {
         margin: 0;
         font-size: 24px;
      }

      .logout {
         color: #fff;
         text-decoration: none;
         font-size: 16px;
         padding: 8px 15px;
         background: #d9534f;
         border-radius: 5px;
         transition: 0.3s;
      }

      .logout:hover {
         background: #c9302c;
      }
   </style>
</head>
<body>

<div class="header">
   <h1>Dashboard Admin</h1>
   <a href="admin_logout.php" class="logout">Logout</a>
</div>

<table>
   <thead>
      <tr>
         <th>ID</th>
         <th>Nama</th>
         <th>Alamat</th>
         <th>No HP</th>
         <th>Jumlah Pesanan</th>
         <th>Varian Rasa</th>
      </tr>
   </thead>
   <tbody>
      <?php while($row = $select_orders->fetch(PDO::FETCH_ASSOC)){ ?>
      <tr>
         <td><?= $row['id']; ?></td>
         <td><?= $row['nama']; ?></td>
         <td><?= $row['alamat']; ?></td>
         <td><?= $row['nohp']; ?></td>
         <td><?= $row['jumlahpesanan']; ?></td>
         <td><?= $row['varianrasa']; ?></td>
      </tr>
      <?php } ?>
   </tbody>
</table>

</body>
</html>
