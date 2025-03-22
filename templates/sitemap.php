<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php
foreach ($collections as $collection) {
	sort($collection->entries);
	foreach ($collection->entries as $entry) {
		if (! ($entry->data['index'] ?? true) ) continue;
		$modurl = $entry->data['url'];	// if data['url'] already has html suffix, then drop it
		if (strlen($modurl) >= 6 && substr($modurl,-5) === '.html') $modurl = substr($modurl,0,-5);
		$href = isset($collection->data['uglyURL']) ? $modurl . '.html' : $modurl;
		printf("\t<url><loc>https://eklausmeier.goip.de/lemire%s</loc></url>\n", $href);
	}
}
?>
</urlset>

