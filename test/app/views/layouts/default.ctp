<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
<!DOCTYPE html>

<!--[if lt IE 7 ]><html lang="ja" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="ja" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="ja" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="ja" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="ja" class="no-js"><!--<![endif]-->

<head>
<meta charset="utf-8">

<title><?php echo $title_for_layout; ?> | <?php __('Dentsu Underground'); ?></title>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="imagetoolbar" content="no" />

<meta name="author" content="Dentsu Underground" />
<meta name="copyright" content="&copy; 2009-2010 Dentsu Underground, Some Rights Reserved." />
<meta name="description" content="電気通信大学の過去問・過去レポ・情報サイト「Dentsu Underground」。" />
<meta name="keywords" content="Dentsu,Dentsu Underground,電通,でんつう,電気通信大学,過去問,過去レポ,課題" />
<meta name="robots" content="index,follow" />
<meta name="robots" content="noodp" />

<link rel="canonical" href="<?php echo $this->Html->url('/', true); ?><?php echo $page; ?>" />
<link rel="author" href="<?php echo $this->Html->url('/', true); ?>humans.txt" />

<link rel="shortcut icon" href="<?php echo $this->Html->url('/', true); ?>assets/favicon.ico" />
<link rel="apple-touch-icon" href="<?php echo $this->Html->url('/', true); ?>assets/favicon.png" />

<link rel="stylesheet" media="screen" href="<?php echo $this->Html->url('/', true); ?>css/base.css?v=1" /><!--Load CSS-->
<link rel="stylesheet" media="handheld" href="<?php echo $this->Html->url('/', true); ?>css/handheld.css?v=1" /><!-- Mobile -->

<script src="<?php echo $this->Html->url('/', true); ?>js/libs/modernizr-1.6.min.js"></script> <!-- Modernizr -->
<?php echo $scripts_for_layout; ?>

</head>
<body>

	<div id="wrapper">

		<div id="top">
			<ul>
				<?php if(isset($current_user['User']['id'])): ?>
				<li><a href="<?php echo $this->Html->url('/twitter/logout.html', true); ?>"><?php __('Logout'); ?></a></li>
				<?php else: ?>
				<li><a href="<?php echo $this->Html->url('/twitter/login.html', true); ?>"><?php __('Login'); ?></a></li>
				<?php endif; ?>
			</ul>
		</div>

		<header id="top">

				<h1 id="logo"><a href="<?php echo $page; ?>"><span class="hidden"><?php __('Dentsu Underground'); ?></span></a></h1>

				<nav>
					<ul><li><a href="<?php echo $this->Html->url('', true); ?>" class="button home left tooltip<?php if ($page == 'index.php') : ?> active<?php endif; ?>" title="Home">Home</a></li><li><a href="<?php echo $this->Html->url('', true); ?>" class="button home middle tooltip<?php if ($page == 'index.php') : ?> active<?php endif; ?>" title="Home">Home</a></li><li><a href="<?php echo $this->Html->url('', true); ?>" class="button home right tooltip<?php if ($page == 'index.php') : ?> active<?php endif; ?>" title="Home">Home</a></li></ul>
				</nav>

		</header><!--end #top-->

		<div id="border"></div>

		<section class="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
		</section><!--end section.content-->

		<?php echo $this->element('sql_dump'); ?>

		<footer id="bottom">

			<nav>
				<ul>
					<li><a href="#top" class="button go-top tooltip" title="Return to top">Return To Top</a></li>
				</ul>
			</nav>

			<p><a href="<?php echo $this->Html->url('/', true); ?>"><strong><?php __('Dentsu Underground'); ?></strong></a> &#47;&#47; Copyright &copy; 2009-<?php echo date("Y"); ?> <a href="<?php echo $this->Html->url('', true); ?>"><?php __('Dentsu Underground'); ?></a>, Some Rights Reserved.</p>

		</footer><!--end #bottom-->

	</div><!--end #wrapper-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script><!--Load jQuery-->
<script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.5.2.min.js"%3E%3C/script%3E'))</script>
<script src="<?php echo $this->Html->url('/', true); ?>js/script.js"></script>
<script src="<?php echo $this->Html->url('/', true); ?>js/jquery.tipsy.js"></script>
<script src="<?php echo $this->Html->url('/', true); ?>js/jquery.reveal.js"></script>
<script src="<?php echo $this->Html->url('/', true); ?>js/jquery.orbit.min.js"></script>

<!--[if lt IE 7 ]>
<script src="js/libs/dd_belatedpng.js"></script>
<script> DD_belatedPNG.fix('img, .png_bg');</script>
<![endif]-->

<!--[if IE 6]>
	<script type="text/javascript">
		/*Load jQuery if not already loaded*/ if(typeof jQuery == 'undefined'){ document.write("<script type=\"text/javascript\"   src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js\"></"+"script>"); var __noconflict = true; }
			var IE6UPDATE_OPTIONS = {
				icons_path: "js/ie6update/images/"
			}
	 </script>
	 <script type="text/javascript" src="js/ie6update/ie6update.js"></script>
<![endif]-->

<!--Google Analytics-->
<script>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-16446253-1']);
_gaq.push(['_trackPageview']);

(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<!--Google Analytics-->

</body>
</html>