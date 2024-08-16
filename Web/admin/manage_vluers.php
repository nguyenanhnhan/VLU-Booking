<?php
//Tạo ra một trang quản lý VLuer với các chức năng quản trị bổ sung và tải trang khi được gọi.
define('ROOT_DIR', '../../');

require_once(ROOT_DIR . 'Pages/Admin/ManageVluersPage.php');

$page = new AdminPageDecorator(new ManageVluersPage());
$page->PageLoad();
