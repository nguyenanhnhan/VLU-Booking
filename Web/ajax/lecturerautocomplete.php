<?php

define('ROOT_DIR', '../../');
require_once(ROOT_DIR . 'Pages/Ajax/LecturerAutoCompletePage.php');

$page = new LecturerAutoCompletePage();
if ($page->GetType() != LecturerAutoCompleteType::Organization) {
    $page = new SecurePageDecorator($page);
}
$page->PageLoad();
