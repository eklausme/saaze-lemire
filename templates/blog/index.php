<?php
$title = "{$collection['title']} (Page {$pagination['currentPage']})";
require SAAZE_PATH . "/templates/top-layout.php";
?>

<main>
	<div id="search"></div><p></p>

<?php foreach ($pagination['entries'] as $entry) { ?>
	<article>
	<h2><a href="<?= '/lemire' . $entry['url'] ?>"><?= $entry['title'] ?? 'Unknown title' ?></a></h2>
	<p class=dimmedColor><time datetime="<?=$entry['date']?>"><?= date('jS F Y', strtotime($entry['date'])) ?></time>, <?=$entry['minutes_read']?> min read</p>
	<p><?= $entry['excerpt'] ?? '---' ?></p>
	</article>
<?php } ?>
</main>
	<aside>
	<?php if ($pagination['nextUrl']) { ?>
	<a href="<?= '/lemire' . $pagination['nextUrl'] ?>">&larr; Older</a> &nbsp; &nbsp; &nbsp;
	<?php } ?>
	<?php if ($pagination['prevUrl']) { ?>
	<a href="<?= '/lemire' . $pagination['prevUrl'] ?>">Newer &rarr;</a>
	<?php } ?>
	</aside>

<?php require SAAZE_PATH . "/templates/bottom-layout.php"; ?>
