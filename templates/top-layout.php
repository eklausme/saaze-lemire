<?php require SAAZE_PATH . "/templates/head.php"; ?>
	<title><?= $title ?? "Saaze" ?></title>

	<link href=/lemire/jscss/prism.css rel=stylesheet>
<style>
<?php require SAAZE_PATH . "/public/jscss/lemire.css" ?>
</style>

<link href="/lemire/pagefind/pagefind-ui.css" rel="stylesheet">
<script src="/lemire/pagefind/pagefind-ui.js"></script>
<script>
	window.addEventListener('DOMContentLoaded', (event) => {
		new PagefindUI({ element: "#search", bundlePath: "/lemire/pagefind/", showSubResults: true, pageSize: 7 });
	});
</script>

</head>

<body>
<?php $rbase ??= '/lemire'; ?>

<div class="grid-container border">

	<header><a href=/lemire/blog><b>Daniel Lemire's blog</b></a><nav id=hamnav><label for=hamburger>&#9776;</label><input type=checkbox id=hamburger>
		<div class=authorBio><p style="line-height:1">Daniel Lemire is a computer science professor at the Data Science Laboratory of the Université du Québec (TÉLUQ) in Montreal.
		His research is focused on software performance and data engineering. He is a techno-optimist and a free-speech advocate.</p>
		</div>
		<div id=hamitems>
			<a href="https://lemire.me/en">My home page</a>
			<a href="https://lemire.me/en/#publications">My publications</a>
			<a href="https://github.com/lemire">My software</a>
			<hr style="color:white; width:100%">
			<a href="https://t.me/dlemire">Follow me on Telegram</a>
			<a href="https://twitter.com/lemire">Follow me on Twitter</a>
			<a href="https://mastodon.social/@lemire">Follow me on Mastodon</a>
			<a href="https://github.com/sponsors/lemire">Sponsor me on GitHub</a>
			<hr style="color:white; width:100%">
			<a href="/lemire/blog/yearOverview"><svg id="yearOverviewIcon" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" height=32 width=32 viewBox="0 0 122.88 121"><defs><style>.cls-1{fill:#ef4136;}.cls-1,.cls-3,.cls-5{fill-rule:evenodd;}.cls-2{fill:gray;}.cls-3{fill:#e6e6e6;}.cls-4{fill:#1a1a1a;}.cls-5{fill:#c72b20;}</style></defs><title>Year Overview</title><path class="cls-1" d="M11.52,6.67h99.84a11.57,11.57,0,0,1,11.52,11.52V44.94H0V18.19A11.56,11.56,0,0,1,11.52,6.67Zm24.79,9.75A9.31,9.31,0,1,1,27,25.73a9.31,9.31,0,0,1,9.31-9.31Zm49.79,0a9.31,9.31,0,1,1-9.31,9.31,9.31,9.31,0,0,1,9.31-9.31Z"/><path class="cls-2" d="M111.36,121H11.52A11.57,11.57,0,0,1,0,109.48V40H122.88v69.46A11.56,11.56,0,0,1,111.36,121Z"/><path class="cls-3" d="M12.75,117.31h97.38a9.1,9.1,0,0,0,9.06-9.06V40H3.69v68.23a9.09,9.09,0,0,0,9.06,9.06Z"/><path class="cls-4" d="M39.54,100.77V66H32.29V58.42l8.6-3.69H51.47v46Zm19.46,0V91.31L73.2,76.8a28.28,28.28,0,0,0,2.27-2.52A11.27,11.27,0,0,0,76.91,72a5.21,5.21,0,0,0,.53-2.27A4.18,4.18,0,0,0,77,67.61a2.82,2.82,0,0,0-1.51-1.2A7.94,7.94,0,0,0,72.83,66H59.73V56.58q3-.69,6.73-1.26a56.19,56.19,0,0,1,8.64-.59,20.11,20.11,0,0,1,8.52,1.48A8.86,8.86,0,0,1,88,60.57a17,17,0,0,1,1.32,7.07,16.89,16.89,0,0,1-3.1,10.08A31.85,31.85,0,0,1,82.6,82l-7.87,8.06H90.59v10.69Z"/><path class="cls-5" d="M86.1,14.63a11.11,11.11,0,1,1-7.85,3.26l.11-.1a11.06,11.06,0,0,1,7.74-3.16Zm0,1.79a9.31,9.31,0,1,1-9.31,9.31,9.31,9.31,0,0,1,9.31-9.31Z"/><path class="cls-5" d="M36.31,14.63a11.11,11.11,0,1,1-7.85,3.26l.11-.1a11.08,11.08,0,0,1,7.74-3.16Zm0,1.79A9.31,9.31,0,1,1,27,25.73a9.31,9.31,0,0,1,9.31-9.31Z"/><path class="cls-4" d="M80.54,4.56C80.54,2,83,0,86.1,0s5.56,2,5.56,4.56V25.77c0,2.51-2.48,4.56-5.56,4.56s-5.56-2-5.56-4.56V4.56Z"/><path class="cls-4" d="M30.75,4.56C30.75,2,33.24,0,36.31,0s5.56,2,5.56,4.56V25.77c0,2.51-2.48,4.56-5.56,4.56s-5.56-2-5.56-4.56V4.56Z"/></svg></a>
			<a href="/lemire/blog/a-short-history-of-technology">A short history of technology</a>
			<a href="/lemire/blog/about-me">About me</a>
			<a href="/lemire/blog/book-recommendations">Book recommendations</a>
			<a href="/lemire/blog/cognitive-biases">Cognitive biases</a>
			<a href="/lemire/blog/interviews-and-talks">Interviews and talks</a>
			<a href="/lemire/blog/my-bets">My bets</a>
			<a href="/lemire/blog/my-favorite-articles">My favorite articles</a>
			<a href="/lemire/blog/favorite-quotes">My favorite quotes</a>
			<a href="/lemire/blog/my-sayings">My rules</a>
			<a href="/lemire/blog/predictions">Predictions</a>
			<a href="/lemire/blog/privacy-policy">Privacy policy</a>
			<a href="/lemire/blog/recommended-video-games">Recommended video games</a>
			<a href="/lemire/blog/terms-of-use">Terms of use</a>
			<a href="/lemire/blog/rules-to-write-a-good-research-paper">Write good papers</a>
			<a href="<?= $rbase ?>/feed.xml"><svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path d="M200-120q-33 0-56.5-23.5T120-200q0-33 23.5-56.5T200-280q33 0 56.5 23.5T280-200q0 33-23.5 56.5T200-120Zm480 0q0-117-44-218.5T516-516q-76-76-177.5-120T120-680v-120q142 0 265 53t216 146q93 93 146 216t53 265H680Zm-240 0q0-67-25-124.5T346-346q-44-44-101.5-69T120-440v-120q92 0 171.5 34.5T431-431q60 60 94.5 139.5T560-120H440Z"/></svg></a>
		</div>
		</nav>
	</header>


