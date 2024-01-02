<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
	<title>Elmar Klausmeier's Blog</title>
	<description>Elmar Klausmeier's Blog</description>
	<lastBuildDate><?=gmdate("r")?></lastBuildDate>
	<link>https://eklausmeier.goip.de</link>
	<atom:link href="https://eklausmeier.goip.de/feed.xml" rel="self" type="application/rss+xml" />
	<generator>Simplified Saaze</generator>
<?php
$rssRelevant = array();
foreach ($collections as $collection) {
	if ( !($collection->data['rss'] ?? false) ) continue;
	foreach ($collection->entries as $entry) {
		if (str_starts_with($entry->data['title'],'Index for Year 2')) continue;
		if ($collection->draftOverride == false && ($entry->data['draft'] ?? false)) continue;//&& array_key_exists('draft',$entry->data
                if ( ! ($entry->data['index'] ?? true) ) continue;
		$rssRelevant[$entry->data['date'] . $entry->data['title']] = $entry;
	}
}
krsort($rssRelevant);	// sort on key=date+title in reverse order
$maxRss = 50;	// number of item's in RSS XML feed
$timeZone = new \DateTimeZone('Europe/Berlin');
foreach ($rssRelevant as $entry) {
	if ($maxRss-- <= 0) break;
	$html = str_replace('<a href="*%3C?=$rbase?%3E*/','<a href="https://eklausmeier.goip.de/',$entry->data['content']);
	//$html = str_replace('<a href="../../2','<a href="https://eklausmeier.goip.de/blog/2',$html);
	$html = str_replace('<img src="*%3C?=$rbase?%3E*/img/','<img src="https://eklausmeier.goip.de/img/',$html);
	$html = str_replace('<img src="/img/','<img src="https://eklausmeier.goip.de/img/',$html);
	$html = str_replace('<img src="*%3C?=$rbase?%3E*/pdf/','<img src="https://eklausmeier.goip.de/pdf/',$html);
	$html = str_replace('<img src="/pdf/','<img src="https://eklausmeier.goip.de/pdf/',$html);
	$html = str_replace('<a href="/koehntopp','<a href="https://eklausmeier.goip.de/koehntopp',$html);
	$html = str_replace('<a href="/jpilot','<a href="https://eklausmeier.goip.de/jpilot',$html);
	// RFC-822 format: Wed, 02 Oct 2002 13:00:00 GMT, previously used 'D, j M Y G:i:s'
	$d = date_create($entry->data['date'],$timeZone);
	printf("\t<item>\n"
		. "\t\t<link>https://eklausmeier.goip.de%s</link>\n"
		. "\t\t<guid>https://eklausmeier.goip.de%s</guid>\n"
		. "\t\t<title>%s</title>\n"
		. "\t\t<pubDate>%s</pubDate>\n"
		. "\t\t<description><![CDATA[\n%s\n"
		. "\t\t]]></description>\n"
		. "\t</item>\n",
		$entry->data['url'], $entry->data['url'], $entry->data['title'], date_format($d,"r"), $html);
}
?>
</channel>
</rss>
