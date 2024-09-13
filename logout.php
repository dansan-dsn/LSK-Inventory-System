<?php
require_once('../root/config.php');
unset($_SESSION['user_id']);
session_destroy();
redirect_page(SITE_URL);

?>