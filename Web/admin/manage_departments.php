<?php

define('ROOT_DIR', '../../');

require_once(ROOT_DIR . 'Pages/Admin/ManageDepartmentsPage.php');

$page = new AdminPageDecorator(new ManageDepartmentsPage());
$page->PageLoad();
