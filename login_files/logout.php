<?php
session_unset();
session_destroy();
header('location:../admin/admin.php')
?>