<?php
session_start();
$db_name = 'mysql:host=localhost;dbname=pisang_sale';
$username = 'root';
$password = '';

$conn = new PDO($db_name, $username, $password);

if(isset($_POST['login'])){
   $admin_username = $_POST['username'];
   $admin_username = filter_var($admin_username, FILTER_SANITIZE_STRING);
   $admin_password = $_POST['password'];
   $admin_password = filter_var($admin_password, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE username = ?");
   $select_admin->execute([$admin_username]);

   if($select_admin->rowCount() > 0){
      $row = $select_admin->fetch(PDO::FETCH_ASSOC);
      if($admin_password == $row['password']){ // Gunakan password_verify jika password di-hash
         $_SESSION['admin_id'] = $row['id'];
         header('location: admin_dashboard.php');
      }else{
         $message = 'Password salah!';
      }
   }else{
      $message = 'Akun tidak ditemukan!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Admin</title>
   <link rel="stylesheet" href="css/style.css">
   <style>
      /* Gaya untuk form login */
      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         display: flex;
         justify-content: center;
         align-items: center;
         min-height: 100vh;
         background: linear-gradient(135deg, #6e8efb, #a777e3);
      }

      .login-form {
         background: #fff;
         padding: 25px 30px;
         border-radius: 10px;
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
         text-align: center;
         max-width: 350px;
         width: 100%;
      }

      .login-form h3 {
         margin-bottom: 20px;
         font-size: 24px;
         color: #333;
      }

      .login-form .box {
         width: 100%;
         padding: 10px;
         margin: 10px 0;
         border: 1px solid #ddd;
         border-radius: 5px;
         outline: none;
         font-size: 14px;
      }

      .login-form .btn {
         width: 100%;
         padding: 10px;
         margin-top: 15px;
         background: #6e8efb;
         border: none;
         color: #fff;
         border-radius: 5px;
         font-size: 16px;
         cursor: pointer;
         transition: background 0.3s;
      }

      .login-form .btn:hover {
         background: #5a75d8;
      }

      .message {
         background: #f8d7da;
         color: #721c24;
         padding: 10px;
         border: 1px solid #f5c6cb;
         margin-bottom: 15px;
         border-radius: 5px;
      }
   </style>
</head>
<body>

<?php
if(isset($message)){
   echo '<div class="message"><span>'.$message.'</span></div>';
}
?>

<div class="login-form">
   <h3>Login Admin</h3>
   <form action="" method="post">
      <input type="text" name="username" required placeholder="Masukkan Username" class="box">
      <input type="password" name="password" required placeholder="Masukkan Password" class="box">
      <input type="submit" name="login" value="Login" class="btn">
   </form>
</div>

</body>
</html>
