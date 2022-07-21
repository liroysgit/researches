<?php
$site_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
header('Location: ' . $site_url . 'researches_list.php');
die();
