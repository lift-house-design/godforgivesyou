<?php

function view_confession($confession)
{
	?>
		<div class="confession-wrap">
			<div class="share">
				<div class="stats">
					<span><?= $confession['forgives']['forgive'] ?> forgive<?= ($confession['forgives']['forgive'] == 1 ? '' : 's') ?></span>
					<span><?= $confession['forgives']['condemn'] ?> condemnation<?= ($confession['forgives']['condemn'] == 1 ? '' : 's') ?></span>
				</div>
				<div class="social">
					<script type="text/javascript">
						a2a_config = {
						    linkname: "<?= htmlspecialchars(substr($confession['text'],0,80)) ?>...",
						    linkurl: "http://<?= $_SERVER['HTTP_HOST'] ?>/confession/<?= $confession['id'] ?>"
						};
					</script>
					<div class="a2a_kit a2a_kit_size_32 a2a_default_style"><a class="a2a_dd" href="http://www.addtoany.com/share_save"></a><a class="a2a_button_twitter"></a><a class="a2a_button_facebook"></a><a class="a2a_button_pinterest"></a><a class="a2a_button_google_plus"></a><a class="a2a_button_tumblr"></a><a class="a2a_button_email"></a></div><script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
				</div>
			</div>
			<div>
				<a href="/confession/<?= $confession['id'] ?>" title="<?= htmlspecialchars($confession['text']) ?>">
					<img src="/image/confessions/<?= $confession['id'] ?>.png" alt="<?= htmlspecialchars($confession['text']) ?>"/>
				</a>
			</div>
			<div class="pad0t pad10l pad9r pad30b forgive" data-id="<?= $confession['id'] ?>">
				<? foreach(['forgive','condemn','ignore','spam'] as $i => $type){ ?>
					<span class="w25pc block <?= ($i == 3 ? '' : 'pad10r' ) ?>">
						<a href="javascript:forgive(<?= $confession['id'] ?>,'<?= $type ?>')" class="index-button w100pc block">
							<?= ucfirst($type) ?>
						</a>
					</span>
				<? } ?>
			</div>
		</div>
	<?
}

function view_prayer($prayer)
{
	?>
		<div class="prayer-wrap">
			<div class="share">
				<div class="stats">
					<span><?= $prayer['prayers_for']['prayer'] ?> prayer<?= ($prayer['prayers_for']['prayer'] == 1 ? '' : 's') ?></span>
				</div>
				<div class="social">
					<script type="text/javascript">
						a2a_config = {
						    linkname: "<?= htmlspecialchars(substr($prayer['text'],0,80)) ?>...",
						    linkurl: "http://<?= $_SERVER['HTTP_HOST'] ?>/prayer/<?= $prayer['id'] ?>"
						};
					</script>
					<div class="a2a_kit a2a_kit_size_32 a2a_default_style"><a class="a2a_dd" href="http://www.addtoany.com/share_save"></a><a class="a2a_button_twitter"></a><a class="a2a_button_facebook"></a><a class="a2a_button_pinterest"></a><a class="a2a_button_google_plus"></a><a class="a2a_button_tumblr"></a><a class="a2a_button_email"></a></div><script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
				</div>
			</div>
			<div>
				<a href="/prayer/<?= $prayer['id'] ?>" title="<?= htmlspecialchars($prayer['text']) ?>">
					<img src="/image/prayers/<?= $prayer['id'] ?>.png" alt="<?= htmlspecialchars($prayer['text']) ?>"/>
				</a>
			</div>
			<div class="pad0t pad10l pad9r pad30b pray" data-id="<?= $prayer['id'] ?>">
				<? foreach(['pray','ignore','spam'] as $i => $type){ ?>
					<span class="w33pc block <?= ($i == 2 ? '' : 'pad10r' ) ?>">
						<a href="javascript:pray(<?= $prayer['id'] ?>,'<?= $type ?>')" class="index-button w100pc block">
							<?= ucfirst($type) ?>
						</a>
					</span>
				<? } ?>
			</div>
		</div>
	<?
}

function nav_active($page, $class=''){
	return strpos($_SERVER['REQUEST_URI'], $page) === 0 ? 'class="active '.$class.'"' : $class;
}

if(!function_exists('css'))
{
	function css($css)
	{
		$html='';
		
		foreach($css as $css_file)
		{
			if(strpos($css_file,'//') === 0)
				$url = $css_file;
			elseif(strpos($css_file,'/') === 0)
				$url = "/assets" . $css_file;
			else
				$url = "/assets/css/" . $css_file;
			$html .= '<link href="'.$url.'" rel="stylesheet" type="text/css"/>'."\n";
		}
		return $html;
	}
}

/* Uses minify library... make sure it's installed */
if(!function_exists('min_css'))
{
	function min_css($css)
	{
		$html='';
		$min_url = '/min/b=assets&f=';
		$min_urls = array();
		foreach($css as $file)
		{
			if(strpos($file,'//') === 0)
				$html .= '<link href="'.$file.'" rel="stylesheet" type="text/css"/>'."\n";
			elseif(strpos($file,'/') === 0)
				$min_urls[] = substr($file,1);
			else
				$min_urls[] = 'css/'.$file;
		}
		if(!empty($min_urls))
			$html .= '<link href="' . $min_url . join(',',$min_urls) . '" rel="stylesheet" type="text/css"/>'."\n";

		return $html;
	}
}

if(!function_exists('js'))
{
	function js($js)
	{
		$html='';
		
		foreach($js as $js_file)
		{
			if(strpos($js_file,'//') === 0)
				$url = $js_file;
			elseif(strpos($js_file,'/') === 0)
				$url = "/assets" . $js_file;
			else
				$url = "/assets/js/" . $js_file;
			$html.='<script src="'.$url.'" type="text/javascript"></script>'."\n";
		}
		return $html;
	}
}

/* Uses minify library... make sure it's installed */
if(!function_exists('min_js'))
{
	function min_js($js)
	{
		$html='';
		$min_url = '/min/b=assets&f=';
		$min_urls = array();
		foreach($js as $file)
		{
			if(strpos($file,'//') === 0)
				$html .= '<script src="'.$file.'" type="text/javascript"></script>'."\n";
			elseif(strpos($file,'/') === 0)
				$min_urls[] = substr($file,1);
			else
				$min_urls[] = 'js/'.$file;
		}
		if(!empty($min_urls))
			$html .= '<script src="'.$min_url . join(',',$min_urls).'" type="text/javascript"></script>'."\n";

		return $html;
	}
}

/* 
	LessCSS should only be used for development. 
	Please compile your .less files before deployment, and make sure the less_css array is empty so that this function returns an empty string.
*/
if(!function_exists('less_css'))
{
	function less_css($css)
	{
		if(empty($css))
			return '';
		$html = '';

		foreach($css as $css_file)
		{
			$url = "/assets/less/" . $css_file;
			$html .= '<link href="'.$url.'" rel="stylesheet/less" type="text/css"/>'."\n";
		}
		$html .= '<script>less = {env: "development", poll: 5000};</script>'."\n";
		$html .= '<script src="/assets/less/less-1.6.1.min.js" type="text/javascript"></script>'."\n";
		$html .= '<script>less.watch()</script>'."\n";
		return $html;
	}
}

?>