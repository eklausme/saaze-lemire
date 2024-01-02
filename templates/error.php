<?php
$title = "{$code} {$message}";
require SAAZE_PATH . "/templates/top-layout.php";
?>

<h1><?= $code ?></h1>
<div><?= $message ?></div>

<?php require SAAZE_PATH . "/templates/bottom-layout.php"; ?>
