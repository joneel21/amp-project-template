<?php
// Get content width
//$content_max_width       = absint( $this->get( 'content_max_width' ) );

// Get template colors
$theme_color             = $this->get_customizer_setting( 'theme_color' );
//$text_color              = $this->get_customizer_setting( 'text_color' );
$muted_text_color        = $this->get_customizer_setting( 'muted_text_color' );
$border_color            = $this->get_customizer_setting( 'border_color' );
$link_color              = $this->get_customizer_setting( 'link_color' );
$header_background_color = $this->get_customizer_setting( 'header_background_color' );
$header_color            = $this->get_customizer_setting( 'header_color' );

$text_color = '#505051';
$content_max_width = absint('1140');

?>
/* Generic WP styling */

* {
    -webkit-tap-highlight-color: rgba(255,255,255,0);
}    
*, *:after, *::before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.hide{
	display:none;
}

.alignright {
	float: right;
}

.alignleft {
	float: left;
}

.aligncenter {
	display: block;
	margin-left: auto;
	margin-right: auto;
}

.amp-wp-enforced-sizes {
	/** Our sizes fallback is 100vw, and we have a padding on the container; the max-width here prevents the element from overflowing. **/
	max-width: 100%;
	margin: 0 auto;
}

.amp-wp-unknown-size img {
	/** Worst case scenario when we can't figure out dimensions for an image. **/
	/** Force the image into a box of fixed dimensions and use object-fit to scale. **/
	object-fit: contain;
}

/* Template Styles */

.amp-wp-content,
.amp-wp-title-bar div {
	<?php if ( $content_max_width > 0 ) : ?>
	margin: 0 auto;
	max-width: <?php echo sprintf( '%dpx', $content_max_width ); ?>;
	<?php endif; ?>
}

body {
	background: <?php echo sanitize_hex_color( $theme_color ); ?>;
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	font-family: Lato;
	font-weight: 400;
	line-height: 1.75em;
	font-size: 16px;
}

p,
ol,
ul,
figure {	
	margin: 0 0 1em;
	padding: 0;
}

a,
a:visited {
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
}

a:hover,
a:active,
a:focus {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
}

/*Custom Menu*/
.menu-bar #st-trigger-effects button {
    border: 3px solid #0397d2!important;
    display: inline-block;
    font-family: "Lato",sans-serif;
    font-size: 26px;
    font-weight: 400;
    height: 51px;
    line-height: 17px;
    margin-right: 10px;
    padding: 0;
    width: 51px;
    word-break: break-all;
    color: #0397d2;    
    cursor: pointer;
    -webkit-transition: all .4s ease-in-out;
    -moz-transition: all .4s ease-in-out;
    -ms-transition: all .4s ease-in-out;
    -o-transition: all .4s ease-in-out;
    transition: all .4s ease-in-out;
}
.menu-bar #st-trigger-effects button:hover {
    background-color: #0397d2!important;
    color: #fff;
    -webkit-animation: none;
    -moz-animation: none;
    -ms-animation: none;
    animation: none;
}
#st-trigger-effects button {
    -webkit-animation: homeCycle 9s linear .6s infinite;
    -moz-animation: homeCycle 9s linear .6s infinite;
    -ms-animation: homeCycle 9s linear .6s infinite;
    animation: homeCycle 9s linear .6s infinite;
    animation-direction: alternate;
    -webkit-animation-direction: alternate;
}

.st-effect-1.st-menu-open .st-effect-1.vertical-st-menu {
    visibility: visible;
    -webkit-transform: translate3d(0,0,0);
    -moz-transform: translate3d(0,0,0);
    -ms-transform: translate3d(0,0,0);
    -o-transform: translate3d(0,0,0);
    transform: translate3d(0,0,0);
    -webkit-box-shadow: 0 2px 60px rgba(0,0,0,.9);
    -moz-box-shadow: 0 2px 60px rgba(0,0,0,.9);
    box-shadow: 0 2px 60px rgba(0,0,0,.9);
}
.st-effect-1.st-menu-open .st-effect-1.vertical-st-menu {   
    opacity: 1;
}

.vertical-st-menu ul {
    margin: 0;
    padding: 0;
    list-style: none;
}
.vertical-st-menu {
    padding-top: 132px;
    position: fixed;
    top: 0;
    right: 0;
    z-index: 98;
    visibility: hidden;
    width: 300px;
    height: 100%;
    background: #0397d2;
    -webkit-transition: all .5s;
    -moz-transition: all .5s;
    -ms-transition: all .5s;
    -o-transition: all .5s;
    transition: all .5s;
}
.vertical-st-menu ul li a {
    display: block;
    padding: 20px 0 20px;
    outline: none;
    color: #fff;
    font-size: 22px;
    border-bottom: 2px solid transparent;
    text-align: center;
	text-decoration: none;
}
.vertical-st-menu ul li a:hover {
    background: rgba(0,0,0,.2);
    border-color: #fff;
    -webkit-box-shadow: inset 0 -1px rgba(0,0,0,0);
    -moz-box-shadow: inset 0 -1px rgba(0,0,0,0);
    box-shadow: inset 0 -1px rgba(0,0,0,0);
}
#close-vertical-menu {
    
}
#close-vertical-menu {
    border-radius: 100%;
    cursor: pointer;
    font-size: 40px;
    height: 40px;
    line-height: 35px;
    position: absolute; 
    width: 40px;
    color: #fff;
	font-size: 38px;
    top: 8px;
    right: 20px;
}
.st-effect-1.st-menu-open .vertical-st-menu .sub-menu {
    background: #006897;
    -webkit-box-shadow: 0 10px 19px 0 rgba(0,0,0,.5);
    -moz-box-shadow: 0 10px 19px 0 rgba(0,0,0,.5);
    box-shadow: 0 10px 19px 0 rgba(0,0,0,.5);
}
.vertical-st-menu .sub-menu {
    background: #006897;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
}
.vertical-st-menu ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

/* Quotes */

blockquote {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	background: rgba(127,127,127,.125);
	border-left: 2px solid <?php echo sanitize_hex_color( $link_color ); ?>;
	margin: 8px 0 24px 0;
	padding: 16px;
}

blockquote p:last-child {
	margin-bottom: 0;
}

/* UI Fonts */

.amp-wp-meta,
.amp-wp-header div,
.wp-caption-text,
.amp-wp-tax-category,
.amp-wp-tax-tag,
.amp-wp-comments-link,
.amp-wp-footer p,
.back-to-top {
	font-family: Lato;
}

/* Header */

h1, h2, h3, h4, h5, h6 {
    font-family: "Josefin Sans";
}
h2, h3, h4, h5, h6 {
	color:<?php echo sanitize_hex_color( $text_color ); ?>;
}
h5{
	font-size: 18px;
}
.call-us, #logo, .nav {
    display: table-cell;
    vertical-align: middle;
    width: 33.33%;
}
.amp-wp-header {
	margin: 0 auto;       
    position: fixed;
    width: 100%;
    text-align: center;
    display: table;
    padding: 15px 0;
	background: #fff url(https://www.meetbluefox.com/wp-content/themes/jupiter-child1/img/headerbg.png) no-repeat scroll center bottom;
	z-index:99;
	top: 0;
}
.call-us {
    text-align: left;
    padding: 0 20px 0;
    color: #0397d2;
    text-transform: uppercase;
    font-size: 16px;
    font-weight: 600;
}
.call-us a, .nav .socials a {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	text-decoration: none;
}
.nav{
	padding: 0;
	text-align: right;
}
.nav .socials, .nav .menu-bar {
    display: inline-block;
}
.nav .socials {
    margin-right: 5px;
}
.nav .socials a {    
    font-size: 18px;
    margin: 0 5px;    
}
.nav .socials a:hover, .call-us a:hover{
	color: #0397d2;
}
.socials {
    vertical-align: top;
    margin-top: 13px;
}
.mk-header-social {
    display: inline-block;
    float: right;
    height: 30px;
}
.mk-header-social ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
.mk-header-social ul li {
    margin: 0;
    display: inline-block;
}
.mk-header-social ul li a {
    position: relative;
    display: block;
    margin: 0 5px;
}

/* Site Icon */

.amp-wp-header .amp-wp-site-icon {
	/** site icon is 32px **/
	background-color: <?php echo sanitize_hex_color( $header_color ); ?>;
	border: 1px solid <?php echo sanitize_hex_color(  $header_color ); ?>;
	border-radius: 50%;
	position: absolute;
	right: 18px;
	top: 10px;
}

/* Article */

.amp-wp-article {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;	
	margin: 1.5em auto;
	max-width: 840px;
	overflow-wrap: break-word;
	word-wrap: break-word;
	padding-top: 80px;
}

/* Article Header */

.amp-wp-article-header {
	align-items: center;
	align-content: stretch;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	margin: 1.5em 16px 1.5em;
}

.amp-wp-title {
	color: white;
    line-height: 1em;
    display: block;
    font-weight: 700;
    margin: 0 0 .625em;
    font-size: 56px;
    width: 100%;	
}

/* Article Meta */

.amp-wp-meta {
	display: block;	
	font-size: .875em;
	line-height: 1.5em;
	margin: 0;
	padding: 0;
}

.amp-wp-article-header .amp-wp-meta:last-of-type {
	text-align: right;
}

.amp-wp-article-header .amp-wp-meta:first-of-type {
	text-align: left;
}

.amp-wp-byline .amp-wp-author {
	display: block;
}

.amp-wp-byline amp-img {
	border: 4px solid #fff;
    border-radius: 50%;
    position: relative;
}

.amp-wp-posted-on {
	text-align: center;
}

/* Featured image */

.amp-blog-hero{
	max-height: 705px;
	overflow:hidden;
	position: relative;
    top: 65px;
}

.amp-wp-article-featured-image amp-img:before{
	position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: #000;
    opacity: .4;
    content: '';
    z-index: 1;

}
.amp-wp-article-featured-image {
	margin: 0 0 1em;
}
.amp-wp-article-featured-image amp-img {
	margin: 0 auto;
	top: -80px;
}
.amp-wp-article-featured-image.wp-caption .wp-caption-text {
	margin: 0 18px;
}

.content-holder{	
    text-align: center;
    position: absolute;
    z-index: 2;
    padding: 30px 0;    
	top: 352px;
    width: 100%;
}


/* Article Content */

.amp-wp-article-content {
	margin: 0 16px;
}

.amp-wp-article-content ul,
.amp-wp-article-content ol {
	margin-left: 1em;
}

.amp-wp-article-content amp-img {
	margin: 0 auto;
}

.amp-wp-article-content amp-img.alignright {
	margin: 0 0 1em 16px;
}

.amp-wp-article-content amp-img.alignleft {
	margin: 0 16px 1em 0;
}

/* Captions */

.wp-caption {
	padding: 0;
}

.wp-caption.alignleft {
	margin-right: 16px;
}

.wp-caption.alignright {
	margin-left: 16px;
}

.wp-caption .wp-caption-text {
	border-bottom: 1px solid <?php echo sanitize_hex_color( $border_color ); ?>;
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0;
	padding: .66em 10px .75em;
}

/* AMP Media */

amp-carousel {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}
amp-iframe,
amp-youtube,
amp-instagram,
amp-vine {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}

.amp-wp-article-content amp-carousel amp-img {
	border: none;
}

amp-carousel > amp-img > img {
	object-fit: contain;
}

.amp-wp-iframe-placeholder {
	background: <?php echo sanitize_hex_color( $border_color ); ?> url( <?php echo esc_url( $this->get( 'placeholder_image_url' ) ); ?> ) no-repeat center 40%;
	background-size: 48px 48px;
	min-height: 48px;
}

/* Article Footer Meta */

.amp-wp-article-footer .amp-wp-meta {
	display: block;
}

.amp-wp-tax-category,
.amp-wp-tax-tag {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	margin: 1.5em 16px;
}

.amp-wp-comments-link {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	text-align: center;
	margin: 2.25em 0 1.5em;
}

.amp-wp-comments-link a {
	border-style: solid;
	border-color: <?php echo sanitize_hex_color( $border_color ); ?>;
	border-width: 1px 1px 2px;
	border-radius: 4px;
	background-color: transparent;
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
	cursor: pointer;
	display: block;
	font-size: 14px;
	font-weight: 600;
	line-height: 18px;
	margin: 0 auto;
	max-width: 200px;
	padding: 11px 16px;
	text-decoration: none;
	width: 50%;
	-webkit-transition: background-color 0.2s ease;
			transition: background-color 0.2s ease;
}

/* AMP Footer */

.amp-wp-footer {
	border-top: 1px solid <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: calc(1.5em - 1px) 0 0;
}

.amp-wp-footer div {
	margin: 0 auto;
	max-width: calc(840px - 32px);
	padding: 1.25em 16px 1.25em;
	position: relative;
}

.amp-wp-footer h2 {
	font-size: 1em;
	line-height: 1.375em;
	margin: 0 0 .5em;
}

.amp-wp-footer p {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .8em;
	line-height: 1.5em;
	margin: 0 85px 0 0;
}

.amp-wp-footer a {
	text-decoration: none;
}

.back-to-top {
	bottom: 1.275em;
	font-size: .8em;
	font-weight: 600;
	line-height: 2em;
	position: absolute;
	right: 16px;
}

@media (max-width: 1366px){
	.vertical-st-menu {
		padding-top: 0;
		margin-top: 87px;		
		width: 100%;
		text-align: center;
		height: 64px;
  	}
	.st-effect-1.vertical-st-menu {
		-webkit-transform: perspective(1000px) translate3d(0,-20px,0) rotateX(-73deg);
		-moz-transform: perspective(1000px) translate3d(0,-20px,0) rotateX(-73deg);
		-ms-transform: perspective(1000px) translate3d(0,-20px,0) rotateX(-73deg);
		-o-transform: perspective(1000px) translate3d(0,-20px,0) rotateX(-73deg);
		transform: perspective(1000px) translate3d(0,-20px,0) rotateX(-73deg);      
		opacity: 0;
	}
  
   .vertical-st-menu ul li {
		display: inline-block;
		margin: auto;
	}
	.vertical-st-menu ul li a {
		padding: 20px 18px;
	}
	.vertical-st-menu .sub-menu {
		position: absolute;
		display: block;
		width: 100%;
		left: 0;
		top: 62px;
	}
}

@keyframes homeCycle
{
	0% {background-color:#0397D2;color:#FFF; }
	20% {background-color:#FFF;color:#0397D2;}
	40% {background-color:#0397D2;color:#FFF;}
	60% {background-color:#FFF;color:#0397D2;}
	80% {background-color:#0397D2;color:#FFF;}
	100% {background-color:#FFF;color:#0397D2;}
}

@-webkit-keyframes homeCycle
{
	0% {background-color:#0397D2;color:#FFF; }
	20% {background-color:#FFF;color:#0397D2;}
	40% {background-color:#0397D2;color:#FFF;}
	60% {background-color:#FFF;color:#0397D2;}
	80% {background-color:#0397D2;color:#FFF;}
	100% {background-color:#FFF;color:#0397D2;}
}
@-moz-keyframes homeCycle
{
	0% {background-color:#0397D2;color:#FFF; }
	20% {background-color:#FFF;color:#0397D2;}
	40% {background-color:#0397D2;color:#FFF;}
	60% {background-color:#FFF;color:#0397D2;}
	80% {background-color:#0397D2;color:#FFF;}
	100% {background-color:#FFF;color:#0397D2;}
}

@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation:portrait){
	.amp-blog-hero{
		max-height: 1024px;
	}
}
@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation:landscape){
	.amp-blog-hero{
		max-height: 768px;
	}
}

/*Forms*/
.ampstart-input{
	text-align: right;
}
.amp-form-submit-success .user-valid{
    display: none;
}
input[type=email], input[type=password], input[type=submit],
input[type=search], input[type=tel], input[type=text], textarea{
	font-family: "Lato";
	font-size: 16px;
	color: #000;
	outline: 0;
    margin-bottom: 14px;
	font-weight: 400;
	border-radius: 0;
	;
}
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  color: #000;
}
::-moz-placeholder { /* Firefox 19+ */
  color: #000;
}
:-ms-input-placeholder { /* IE 10+ */
  color: #000;
}
:-moz-placeholder { /* Firefox 18- */
  color: #000;
}

.input{
	height: 35px;
}
.textarea{
	height: 95px;
}
.input, .textarea{
	background-color: rgba(0,0,0,0);
	border: 1px solid #505051;
	border-width: 0 0 2px;
	width: 100%
}
input.ampstart-btn{	
	font-weight: 600;
	padding: 12px 15px;
	text-transform: uppercase;
	border:none;
	border-bottom: 2px solid #0096cf;
	background-color: rgba(0,0,0,0);
	color: #0096cf;
	letter-spacing: 1px;
	cursor: pointer;
}
input.ampstart-btn:hover{
	background-color: #0096cf;
    color: #fff;
}
input{
	-webkit-transition: all .3s linear !important;
    -moz-transition: all .3s linear !important;
    -ms-transition: all .3s linear !important;
    -o-transition: all .3s linear !important;
    transition: all .3s linear !important;
}

.input.valueMissing{
	border-color: #0096cf;
}

/*Recent Posts*/
#recent_posts-3 ul{
	margin-left: 0;
}
.widget_posts_lists ul li {
    margin-bottom: 20px;
}
.widget_posts_lists ul li {
    overflow: hidden;
    margin: 0 0 12px;
    padding: 0;
    list-style: none;
}
.widget_posts_lists ul li .post-list-thumb {
    position: relative;
    float: left;
    overflow: hidden;
    margin: 0 7px 0 0;
    width: 80px;
}
.post-list-meta{
	display: none;
}
.post-list-image .desc{
	font-size: 14px;
	line-height: 1.2em;
}
.post-list-image img {
    width: 100%;
    height: auto;
}
.widget_posts_lists ul li .post-list-info {
    margin: 0 0 5px 100px;
}
.widget_posts_lists ul li .post-list-title {
    display: inline-block;
    font-size: 15px;
    font-weight: bold;
    line-height: normal;
	color: #505051;
	text-decoration: none;
}
.widget_posts_lists ul li .post-list-title:hover{
	color: #0a89c0;
}

/*Find Follow us*/
.find-follow-container .socials {
    border-bottom: 2px solid #505051;
    display: inline-block;
    margin-bottom: 20px;
    margin-top: 0;
    padding-bottom: 8px;
    text-align: center;
    vertical-align: top;
    width: 100%;
}
.find-follow-container .socials a {
    color: #0096cf;
    display: inline-block;
    font-size: 26.64px;
    margin: 0 6px;
    vertical-align: top;
	letter-spacing: 2px;
}
.find-follow-container address {
    display: inline-block;
    font-style: normal;
    vertical-align: top;
    width: 100%;
}
.find-follow-container address h5 {
    color: #505051;
    font-family: "Lato",sans-serif;
    font-weight: 400;
    margin: 0 0 5px;
}
.find-follow-container address h5 span, .find-follow-container address p span {
    color: #0096cf;
}
.find-follow-container address p {
    color: #505051;
    font-size: 16px;
    font-weight: 300;
    line-height: 18px;
    margin: 0 0 8px;
}
.find-follow-container address a{
	color: #505051;
}
.find-follow-container address a:hover{
	color: #0397d2;
}

/*Footer Links*/

    
/*Custom Footer Section*/

.footer-container{
	position: relative;
    left: 0;
}
footer{
	display: block;
}
.amp-grid{
	width: 96%;
	margin: 0 auto;	
	max-width:<?php echo sprintf( '%dpx', $content_max_width ); ?>;
}
.amp-grid:after {
    content: "";
    display: table;
    clear: both;
}

#amp-footer{
	background-color: #3d4045;
	color: #fff;
    font-size: 13px;
    font-weight: 300;
	width: 100%;
    position: relative;
    padding: 20px 0 0;
}
.amp-padding-wrapper {
    padding: 0 20px;
}
#amp-footer .footer-wrapper {
    padding: 30px 0;
	position: relative;
}
#amp-footer [class*='amp-col-'] {
    padding: 0 2%;
}

.amp-col-1-3 {
    width: 33.33%;
}
[class*=amp-col-] {
    float: left;
    padding-right: 25px;
    min-height: 1px;
}
[class*=amp-col-]{
	box-sizing: border-box;
}
#amp-footer .widgettitle{
    font-size: 18px;
    text-transform: capitalize;
    margin-bottom: 7px;
    font-weight: 400;
	color: #0096cf;
}
#sub-footer {
    background-color: #43474d;
}
.amp-footer-copyright, #amp-footer-navigation li a {
    color: #8c8e91;
}
.amp-footer-copyright {
    font-size: 11px;
    letter-spacing: 1px;
}
.amp-footer-copyright {
    float: left;
    padding: 25px 0 20px 2%;
    font-size: bold;
    opacity: .8;
}

/*Footer Widget*/
#amp-footer-top {
    background-color: #fff;
    padding: 90px 0;
	position: relative;
    display: -webkit-box;
}
.amp-wp-footer .widget {
    margin-bottom: 40px;
}
#amp-footer-top .col-widget {
    background-color: #fff;
    box-shadow: 0 0 35px rgba(0,0,0,.3);
    padding: 35px 25px;
    max-width: 340px;    
    position: relative;
}
#amp-footer-top .widget .widget-title {
    color: #505051;
    font-size: 22px;
    font-weight: 700;   
	letter-spacing: 1px;
	margin: 0 0 20px;
    text-transform: uppercase;
}

/*Social Share*/
.amp-social-share-facebook.custom-style{
	background-image: url(https://www.meetbluefox.com/wp-content/themes/jupiter/assets/images/social-icons/facebook.svg);
    background-color: white;
}
.amp-social-share-twitter.custom-style{
	background-image: url(https://www.meetbluefox.com/wp-content/themes/jupiter/assets/images/social-icons/twitter.svg);
    background-color: white;
}

@media (max-width: 768px){
	#amp-footer-top .widget{
		max-width: 100%;
	}
	.amp-col-1-3 {
		width: 100%;
	}
	[class*=amp-col-]{
		width: auto;
		float: none;
		margin-left: 0;
		margin-right: 0;
		margin-bottom: 20px;
		padding-left: 20px;
		padding-right: 20px;
	}
}