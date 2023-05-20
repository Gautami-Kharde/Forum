<?php

session_start();





echo "logging you out. Please wait......";

session_destroy();
header("Location: /Forum/index.php");
?>