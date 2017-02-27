<?php
session_start();
session_unset();
session_destroy();
require("../config.php");
header("location:". BASE_PATH_ADMIN);
?>