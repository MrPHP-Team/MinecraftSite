<?php
  include ("/locale.php");
  include ("anti_ddos/start.php"); // Anti-ddos protected this. Use module Anti-ddos.

  if (locale == "ru") {
    include("/locale/ru/index.php");
  } else {
    if (locale == "en") {
      include("/locale/en/index.php");
    }
  }
?>
