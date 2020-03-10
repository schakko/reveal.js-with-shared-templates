<?php
/**
 * This PHP script just wraps the content of the presentation between the markers into its own header and footer
 */
define('BASE', dirname(__FILE__) . '/presentation');

$presentation = 'demo';
$directoryRevealJs = "reveal.js/";
$directoryCss = "css/";
// these two markers have to be used to declare the content of our presentation
$markerBegin = '<!--reveal.js:BEGIN-->';
$markerEnd = '<!--reveal.js:END-->';

$header = <<<HEADER
<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">

		<title>reveal.js - The HTML Presentation Framework</title>

		<meta name="description" content="A framework for easily creating beautiful presentations using HTML">
		<meta name="author" content="Hakim El Hattab">

		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="{$directoryCss}/reset.css">
		<link rel="stylesheet" href="{$directoryCss}/reveal.css">
		<link rel="stylesheet" href="{$directoryCss}/theme/black.css" id="theme">

		<!-- Theme used for syntax highlighting of code -->
		<link rel="stylesheet" href="lib/css/monokai.css">

		<!-- Printing and PDF exports -->
		<script>
			var link = document.createElement( 'link' );
			link.rel = 'stylesheet';
			link.type = 'text/css';
			link.href = window.location.search.match( /print-pdf/gi ) ? '{$directoryCss}/print/pdf.css' : '{$directoryCss}/print/paper.css';
			document.getElementsByTagName( 'head' )[0].appendChild( link );
		</script>

		<!--[if lt IE 9]>
		<script src="{$directoryRevealJs}lib/js/html5shiv.js"></script>
		<![endif]-->
	</head>

	<body>
HEADER;

$footer = <<<FOOTER

		<script src="{$directoryRevealJs}js/reveal.js"></script>

		<script>

			// More info https://github.com/hakimel/reveal.js#configuration
			Reveal.initialize({
				controls: true,
				progress: true,
				center: true,
				hash: true,

				transition: 'slide', // none/fade/slide/convex/concave/zoom

				// More info https://github.com/hakimel/reveal.js#dependencies
				dependencies: [
					{ src: '{$directoryRevealJs}plugin/markdown/marked.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
					{ src: '{$directoryRevealJs}plugin/markdown/markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
					{ src: '{$directoryRevealJs}plugin/highlight/highlight.js' },
					{ src: '{$directoryRevealJs}plugin/search/search.js', async: true },
					{ src: '{$directoryRevealJs}plugin/zoom-js/zoom.js', async: true },
					{ src: '{$directoryRevealJs}plugin/notes/notes.js', async: true }
				]
			});

		</script>

	</body>
</html>
FOOTER;

$s = file_get_contents(BASE . "/" . $presentation . "/index.html");
$start = strpos($s, $markerBegin) + strlen($markerBegin);
$end = strpos($s, $markerEnd);

$content = substr($s, $start, $end - $start);

echo $header;
echo $content;
echo $footer;
exit;