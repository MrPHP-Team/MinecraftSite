<?php
include('auth_vk.php');
$id_app     = '7484074';
$url_script = 'https://localhost/adminMine/auth_vk.php';
$name = $_SESSION['name'];
$id = $_SESSION['uid']
?>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <style>
    body {
      background: #c7b39b url(/img/city.jpg); /* Цвет фона и путь к файлу */
    }
  </style>
</head>
<body>
  <div class="row-cols-6">
    <center>
      <a href=' <?php echo 'https://oauth.vk.com/authorize?client_id='.$id_app.'&redirect_uri='.$url_script.'&response_type=code'; ?> ' class="row">
        <?php
          if ($id == 458989589 || $id == 514609372) {
            header("/adminMine/admin.php");
          } else {
            print "Fuck You";
          }
        ?>
        Войти через ВК
      </a>
      </p>
    </center>
  </div>
</body>
