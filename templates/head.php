<!DOCTYPE html>
<html lang="<?= $entry['lang'] ?? 'en' ?>">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAAAAAAD//gA7Q1JFQVRPUjogZ2QtanBlZyB2MS4wICh1c2luZyBJSkcgSlBFRyB2ODApLCBxdWFsaXR5ID0gOTAK/9sAQwADAgIDAgIDAwMDBAMDBAUIBQUEBAUKBwcGCAwKDAwLCgsLDQ4SEA0OEQ4LCxAWEBETFBUVFQwPFxgWFBgSFBUU/9sAQwEDBAQFBAUJBQUJFA0LDRQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQU/8AAEQgAIAAgAwEiAAIRAQMRAf/EABgAAAMBAQAAAAAAAAAAAAAAAAUGBwgE/8QAKxAAAQMDBAECBgMBAAAAAAAAAQIDBAUGEQAHEiExCBMiQVFhcYEyYpGh/8QAGAEAAgMAAAAAAAAAAAAAAAAAAgUBAwb/xAAfEQEAAgICAgMAAAAAAAAAAAABAgMABBEhEjETIkH/2gAMAwEAAhEDEQA/AC9yV9T9rUrlyjxUMe4pHIHpIOT/AM0C2h9M7++dtIvG8KlOdgVIe/TaFAkrYisRs/Ap3iQXFqAycnAzj8Gl7I1tG1Eq43JMI0hDa4yyJWHO8pJAPjzqu7VUO6bFsW0KRT5FONGp8ZEOoLWklxQSMBTf3PR/esyrXH6vePdKMLrFTnjMa747IDYdldWtqpT34ccqdl0uc97rbiATyLZPaFAdjvBxo3trTVXbUmWm3nURylLoU00V5BGR+OtMvqARct90i4pU5ymt0sOyIDMdhBQ8haSpABz5JHFXy8/vXfsTcNH26oUdqp1YErQlCW22gSOIAyT9etD8kmtfbk7tMK7BDgcB70w5C9uKhJRKkojwkGSuO26pKHcA9FOcE6YfSVuPUL02TXMuOoKjsQqhIhqlPOqWhCQhCkJcWoE44qIB/rjWMK76oLjuRKmqpQLVnxiOHsyqWp0gZyMOFzmk+RlKge/xig+lXfd2zLrqjDcVFNsya0hqbAS+pz2XFKPB1CldnjlXRyeAwSojOmLqJW/ri7V2Su076xi393BptkQKvHocxirsLlh8qiPH2Qo9EJVjtX8lE9+Bpy2a2hd3YpVHmM1VtiNPRlBHxKR1khQ+R+x1BvWDeNr1C+1UC2XETINNQTJmtjIclE5WlJ8YGAnPjr/UjbDfBW3c+FUYdtsMz4oBTPp1WmwZDihnC1qbcKVH7FGD9NCa02o8OpOWbWxC25ZejrP/2Q==" width=32 height=32 rel="icon" type="image/jpeg">

<?php
	$lemireUrl = $url;
	$commentUrl = "";
	if (preg_match('/\/blog\/(\d\d\d\d)\/(\d\d)-(\d\d)-(.+)/',$url,$matches)) {
		$lemireUrl = '/blog/'. $matches[1] . '/' . $matches[2] . '/' . $matches[3] . '/' . $matches[4];
		$commentUrl = '/blog/'. $matches[1] . '/' . $matches[2] . '-' . $matches[3] . '-comment-' . $matches[4];
	}
	$includeHashOver = false;	// HashOver comments only on comment pages
	//if ($url === $commentUrl)
	if (preg_match('/\/blog\/(\d\d\d\d)\/(\d\d)-(\d\d)-comment-(.+)/',$url))
		$includeHashOver = true;
?>
	<link rel="canonical" href="https://lemire.me<?=$lemireUrl??''?>">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="https://eklausmeier.goip.de/lemire/feed.xml">
<?php if (isset($pagination)) { ?>
	<meta name="description" content="Daniel Lemire's Blog">
<?php } else if (isset($entry['description'])) { ?>
	<meta name="description" content="<?=$entry['description']?>">
<?php } ?>
	<meta name="author" content="Daniel Lemire">
	<meta name="copyright" content="Daniel Lemire">
	<meta name="generator" content="Simplified Saaze">
