<?php

define('ROOT_DIR', '../../');
require_once(ROOT_DIR . 'Pages/Ajax/DepartmentAutoCompletePage.php');

$page = new DepartmentAutoCompletePage();
if ($page->GetType() != DepartmentAutoCompleteType::Organization) {
    $page = new SecurePageDecorator($page);
}
$page->PageLoad();
