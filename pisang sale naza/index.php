<?php

$db_name = 'mysql:host=localhost;dbname=pisang_sale';
$username = 'root';
$password = '';

$conn = new PDO($db_name, $username, $password);

if(isset($_POST['send'])){

   $name = $_POST['nama'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $alamat = $_POST['alamat'];
   $alamat = filter_var($alamat, FILTER_SANITIZE_STRING);
   $nohp = $_POST['nohp'];
   $nohp = filter_var($nohp, FILTER_SANITIZE_STRING);
   $jumlahpesanan = $_POST['jumlahpesanan'];
   $jumlahpesanan = filter_var($jumlahpesanan, FILTER_SANITIZE_STRING);
   $varianrasa = $_POST['varianrasa'];
   $varianrasa = filter_var($varianrasa, FILTER_SANITIZE_STRING);

   try {
       // Pengecekan apakah data sudah ada sebelumnya
       $select_order = $conn->prepare("SELECT * FROM `order` WHERE nama = ? AND alamat = ? AND nohp = ? AND jumlahpesanan = ? AND varianrasa = ?");
       $select_order->execute([$name, $alamat, $nohp, $jumlahpesanan, $varianrasa]);

       if($select_order->rowCount() > 0){
          $message[] = 'Pesanan sudah terdaftar sebelumnya!';
       } else {
          // Memperbaiki statement INSERT INTO sesuai dengan nama tabel yang benar
          $insert_order = $conn->prepare("INSERT INTO `order` (nama, alamat, nohp, jumlahpesanan, varianrasa) VALUES (?, ?, ?, ?, ?)");
          $insert_order->execute([$name, $alamat, $nohp, $jumlahpesanan, $varianrasa]);
          $message[] = 'Pesanan berhasil disimpan!';
       }
   } catch (PDOException $e) {
       echo "Error: " . $e->getMessage(); // Menampilkan pesan error jika terjadi kesalahan
   }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Website Pisang Sale Naza</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<!-- header section starts  -->

<header class="header">

   <section class="flex">

      <a href="#home" class="logo"><img src="images/Logonaza.png" alt=""></a>

      <nav class="navbar">
         <a href="#home">home</a>
         <a href="#about">about</a>
         <a href="#menu">menu</a>
         <a href="#gallery">gallery</a>
         <a href="#contact">contact</a>
      </nav>

      <div id="menu-btn" class="fas fa-bars"></div>

   </section>

</header>

<!-- header section ends -->

<!-- home section starts  -->

<div class="home-bg">
      <section class="home" id="home">
        <div class="content">
          <h3>Pisang Sale Naza</h3>
          <p>
            Cemilan sehat dan bergizi dari pisang buai asli.
          </p>
          <a href="#about" class="btn">about us</a>
        </div>
      </section>
    </div>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">
      <div class="image">
        <img src="images/1.jpg" alt="" />
      </div>

      <div class="content">
        <h3>Mau Ngemil Sehat? Pisang Sale Naza Solusinya</h3>
        <p>
        Pisang sale naza merupakan cemilan dari pisang buai asli, 
        yang bisa dijadikan sebagai cemilan untuk santai dengan keluarga 
        dan dapat dijadikan pula sebagai oleh oleh khas dari kota Payakumbuh. 
        Pisang sale sendiri merupakan produk olahan tradisional 
        yang telah lama digemari dan diminati oleh masyarakat Indonesia. 
        Produk ini dihasilkan melalui proses pengeringan pisang hingga kadar airnya berkurang, 
        sehingga menghasilkan tekstur unik yang renyah dan memiliki cita rasa manis alami yang khas.
        </p>
        <a href="#menu" class="btn">our menu</a>
      </div>
    </section>

<!-- about section ends -->

<!-- menu section starts  -->

<section class="menu" id="menu">

   <div class="heading">
      <h3>varian rasa</h3>
   </div>

   <div class="box-container">

      <div class="box">
         <img src="images/original.jpg" alt="">
         <h3>Original</h3>
      </div>

      <div class="box">
         <img src="images/coklat.jpg" alt="">
         <h3>Cocholate</h3>
      </div>

      </div>
    </section>

<!-- menu section ends -->

<!-- gallery section starts  -->

<section class="gallery" id="gallery">

   <div class="heading">
      <h3>galeri kami</h3>
   </div>

   <div class="box-container">
      <img src="images/gallery-1.jpg" alt="">
      <img src="images/gallery-2.jpg" alt="">
      <img src="images/gallery-3.jpg" alt="">
      <img src="images/gallery-4.jpg" alt="">
      <img src="images/gallery-5.jpg" alt="">
      <img src="images/gallery-6.jpg" alt="">
   </div>

</section>

<!-- gallery section ends -->

<!-- contact section starts  -->

<section class="contact" id="contact">

   <div class="heading">
      <h3>Orderan</h3>
   </div>

   <div class="row">

      <div class="image">
         <img src="images/contact-img.jpg" alt="">
      </div>

      <form action="" method="post">
      <h3>order produk</h3>
         <input type="text" name="nama" required class="box" maxlength="20" placeholder="masukkan nama">
         <input type="text" name="alamat" required class="box" maxlength="20" placeholder="masukkan alamat">
         <input type="text" name="nohp" required class="box" maxlength="20" placeholder="masukkan nomor hp" min="0" max="9999999999" onkeypress="if(this.value.length == 12) return false">
         <input type="number" name="jumlahpesanan" required class="box" maxlength="20" placeholder="masukkan jumlah pesanan" min="0" max="99" onkeypress="if(this.value.length == 2) return false">
         <input type="text" name="varianrasa" required class="box" maxlength="20" placeholder="masukkan varian rasa">
         <input type="submit" name="send" value="send message" class="btn">
      </form>

   </div>

</section>

<!-- contact section ends -->

<!-- footer section starts  -->

<section class="footer">
   <div class="heading">
      <h3>Contact Us</h3>
   </div>

      <div class="box-container">
        <div class="box">
          <i class="fa-brands fa-instagram"></i>
          <h3>instagram</h3>
          <p>@pisang_sale_naza</p>
        </div>

        <div class="box">
          <i class="fa-brands fa-facebook"></i>
          <h3>facebook</h3>
          <p>Metha</p>
        </div>

        <div class="box">
          <i class="fas fa-map-marker-alt"></i>
          <h3>Lokasi</h3>
          <p>Baruah Gunung</p>
          <p>Lampasi, Payakumbuh</p>
        </div>

        <div class="box">
          <i class="fas fa-phone"></i>
          <h3>nomor telepon</h3>
          <p>+62-853-6502-2723</p>
        </div>
      </div>

    </section>

<!-- footer section ends -->























<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>