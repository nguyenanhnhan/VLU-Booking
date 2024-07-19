<?php

define('ROOT_DIR', '../../');

require_once(ROOT_DIR . 'Pages/Admin/ManageVluersPage.php');

$page = new AdminPageDecorator(new ManageVluersPage());
$page->PageLoad();
