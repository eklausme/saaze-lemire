<?php require SAAZE_PATH . "/templates/top-layout.php"; ?>

	<main><br>
	<div id="search"></div><p></p>

	<article>
	<p class=dimmedColor><?php if (isset($entry['date'])) {?><time datetime="<?=$entry['date']?>"><?= date('jS F Y', strtotime($entry['date'])) ?></time>, <?php } ?><?=$entry['minutes_read']?> min read</p>
<h1><?= $entry['title'] ?></h1>
<?php
	if (getenv('NON_NGINX')) printf("<p>Original post is here <a href=\"https://eklausmeier.goip.de/lemire%s\">eklausmeier.goip.de/lemire%s</a>.</p>\n<br>\n",$url,$url);
	echo $entry['content'];
?>
	</article>
	</main>

	<br><br>
	<aside><div id="hashover"></div>
	</aside>

<?php require SAAZE_PATH . "/templates/bottom-layout.php"; ?>
