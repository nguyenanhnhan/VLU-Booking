<?php

define('ROOT_DIR', '../../');
require_once(ROOT_DIR . 'Pages/Ajax/StudentAutoCompletePage.php');

$page = new StudentAutoCompletePage();
if ($page->GetType() != StudentAutoCompleteType::Organization) {
    $page = new SecurePageDecorator($page);
}
$page->PageLoad();
