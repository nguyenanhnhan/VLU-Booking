<?php

define('ROOT_DIR', '../../');

require_once(ROOT_DIR . 'Pages/Admin/ManageLecturersPage.php');

$page = new AdminPageDecorator(new ManageLecturersPage());
$page->PageLoad();
