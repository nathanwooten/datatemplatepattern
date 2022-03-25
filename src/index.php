<?php

/** Defines */

// directory separator
if ( ! defined( 'DS' ) ) define( 'DS', DIRECTORY_SEPARATOR );

// website/project root folder on the device
if ( ! defined( 'ROOTPATH' ) ) define( 'ROOTPATH', dirname( dirname( __FILE__ ) ) . DS );

// folder for keeping content (in .txt files)
if ( ! defined( 'WRITEPATH' ) ) define( 'WRITEPATH', ROOTPATH . 'write' . DS );

/** Request */

// requested server URI
$url = $_SERVER[ 'REQUEST_URI' ];

// grab only the path portion of the URL
$url = parse_url( $url, PHP_URL_PATH );

// format url to normalized ( the format the file path will be in )
$url = trim( $url, '/' );

// homepage normalization
if ( '' === $url ) {
	$url = 'homepage';
}

/** The Data Layer **/

	// source (content)

$title = $url;
$content = WRITEPATH . $url . '.txt';

	// prepare (content)

function titleWords( $url ) {

	$titleWords = '';

	//make array from url parts (separated by dashes)
	foreach ( explode( '-', $url ) as $key => $word ) {
	//add space, skip initial
    if ( 1 <= $key ) {
			$titleWords .= ' ';
		}
	//capitalize first character and add to phrase
    $titleWords .= ucfirst( $word );
	}

	//return phrase
	return $titleWords;

}

$title = titleWords( $title );
$content = ( file_exists( $content ) && is_readable( $content ) ) ? file_get_contents( $content ) : null;
if ( is_null( $content )) {
	if ( '/' !== $url ) {
		header( 'Location: /' );
	}
	die( 'No content error, please contact the administrator.' );
}
$content = '<p>' . str_replace( "\n\n", "</p>\n<p>", str_replace( "\r\n", "\n", $content ) ) . '</p>';

		// create the (menu)

$menu = '<ul>';
foreach ( scandir( WRITEPATH ) as $item ) {

			// skip dots
	if ( '.' === $item || '..' === $item ) {
		continue;
	}

			// item without file type extension
	$item = basename( $item, '.txt' );

			// list item wrapping a link
	$menu .= '<li><a href="' . $item . '">' . titleWords( $item ) . '</a></li>';
}
$menu .= '</ul>';

/** The Template Layer */

	// define the template with HEREDOC syntax and the input supplied above

$template = <<<EOT
<!-- doctype of the document which is HTML 5 -->
<!DOCTYPE html>

<!-- HTML element with lang attribute included -->
<html lang="en">

<!-- the HEAD or meta portion of an HTML document -->
<head>

<!-- the title of your webpage, shows up in title bar and in search engines -->
<title>{$title}</title>

<!-- the styles of the document -->
<style type="text/css">

/** h1 and p elements */
h1, p {
	padding: 10px;
}

/** p only */
p {
	font-family: Verdana;
}

/** specifiy link color */
a {
	color: blue
}

/** specify list style (square bullets) */
ul {
	list-style-type: square;
}

/** center class */
.center {
	text-align: center;
}
</style>
</head>

<!-- the BODY, or user-viewable portion of the HTML document -->
<body style="margin: 0;">

<!-- a paragraph element wrapping a strong element, wrapping the name of your website -->
<p class="center" style="background-color: #EEE;"><strong>nameofyourwebsitehere</strong></p>

<!-- the menu, consisting of an unorderlist of the files in your write folder -->
{$menu}

<!-- a heading level 1 element -->
<h1>{$title}</h1>

<!-- the text of your content file wrapped in paragraph tags -->
{$content}

</body></html>
EOT;

	// print the template to the screen

print $template;
