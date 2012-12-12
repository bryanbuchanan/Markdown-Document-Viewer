<?

$dev = true;

// Get Content
$uri = $_SERVER['REQUEST_URI'];
$page = $_GET['page'];
if ($page == "index"):
	$file = "..$uri/index.txt";
else:
	$file = "..$uri.txt";
endif;

if (is_file($file)):
	$content = file_get_contents($file);
else:
	$content = "# Page Not Found\n\nSorry, this page doesn't exist.";
endif;

// Get Title
preg_match("/^# (.+)$/im", $content, $title);
$title = $title[1];

// Format
require "library/markdown.inc.php";
$content = Markdown($content);

?>
<!doctype html>
<html>
<head>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">

	<title><?= $title ?></title>
	
	<? if ($dev): ?>

		<!-- Stylesheets: Development -->
		<link href="/_index/scss/precedents.scss" rel="stylesheet">
		<link href="/_index/scss/layout.scss" rel="stylesheet">
		<link href="/_index/scss/content.scss" rel="stylesheet">
		<link href="/_index/scss/mobile.scss" rel="stylesheet">
		<link href="/_index/scss/print.scss" rel="stylesheet">

	<? else: ?>

		<!-- Stylesheets: Production -->
		<link href="/_index/cache/styles.css" rel="stylesheet">

	<? endif ?>
	
	<!-- Typekit -->
	<script src="//use.typekit.net/yhe5ciw.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>	

	<!-- Internet Exploder -->
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<!--[if lt IE 7]><script type="text/javascript">window.location="http://usestandards.com/upgrade?url="+document.location.href;</script><![endif]-->
	
</head>
	
<body>
	
	<section id="content">
	
		<a id="logo" href="http://resen.co/" target="_blank" rel="external">Resen</a>
		<a class="button pdf" href="http://docraptor.com/docs/from_site/?name=Resen_Doc&amp;strict=none&amp;document_type=pdf&amp;test=false">Download PDF</a>

		<?= $content ?>
								
	</section>	

	<footer>

		<p>
			<a href="mailto:info@resen.co">info@resen.co</a> / ph: 424-645-1647 / fax: 424-226-4611 / View: <a href="<?= "$page.txt" ?>">plain text</a> / <a href="http://docraptor.com/docs/from_site/?name=Resen_Doc&amp;strict=none&amp;document_type=pdf">PDF</a>
			<br>
			&copy; Copyright <?= date('Y') ?> Resen Corp. All Rights Reserved.
		</p>
		
	</footer>
		
	<!-- Google Analytics -->
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	try {
	var pageTracker = _gat._getTracker("UA-6281182-26");
	pageTracker._trackPageview();
	} catch(err) {}</script>

</body>
</html>



