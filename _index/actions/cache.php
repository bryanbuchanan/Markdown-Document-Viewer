<?

$css_files = array(
"precedents.scss",
"layout.scss",
"content.scss",
"mobile.scss",
"print.scss"
);

$js_files = array(
"functions.js"
);

$cache_folder = "../cache";

/* CSS
---------------------------------- */

$host = str_replace(':443', '', $_SERVER['HTTP_HOST']);
$css_path = "http://$host/_template/scss";

require "../library/scss.inc.php";
$scss = new scssc();

function combineCSS($files) {
	global $scss;
	global $css_path;
	$css = "";
	foreach ($files as $file):
		if (preg_match('/\.scss$/i', $file)):
			$css .= $scss->compile(file_get_contents("$css_path/$file"));
		else:
			$css .= file_get_contents("$css_path/$file");
		endif;
	endforeach;
   	$css = preg_replace('/\/\*.*?\*\//msi', '', $css);
    $css = preg_replace('/\s+/m', ' ', $css);   	
	$css = trim($css);
	return $css;
}

$styles = fopen("$cache_folder/styles.css", "w") or die("can't open css file");
fwrite($styles, combineCSS($css_files));
fclose($styles);

/* JS
---------------------------------- */

require "../library/minify/minify.php";
$js_path = "/_template/scripts";
$minifyJS = new Minify(TYPE_JS);
foreach($js_files as $file) $minifyJS->addFile("$js_path/$file");
$scripts = fopen("$cache_folder/scripts.js", "w") or die("Can't open js file");
$js = $minifyJS->combine();
fwrite($scripts, $js);
fclose($scripts);

?>