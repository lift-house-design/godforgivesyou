<div class="spacer150"></div>

<script> var user = <?= ($logged_in ? $user['id'] : 0) ?>, butt_check = '00<?= sha1(rand(0,time())) ?>'; </script>
<div id="footer" class="pad20 top-bordered">
	<div class="w33pc align-left">
		<b>Confessions</b>
		<br/>
		<a href="/ask_for_forgiveness" title="Ask for Forgiveness">
			Ask Forgiveness
		</a>
		<br/>
		<a href="/forgive_sins" title="Forgive the sins of others">
			Forgive Sins
		</a>
		<br/>
		<a href="/confessions" title="Recent Confessions">
			Recent Confessions
		</a>
		<br/>
		<a href="/best_confessions" title="Top Confessions">
			Most Forgiven
		</a>
	</div>
	<div class="w33pc align-center">
		<b>Prayers</b>
		<br/>
		<a href="/pray_with_us" title="Submit a Prayer">
			Send a Prayer
		</a>
		<br/>
		<a href="/prayers" title="Pray for Others">
			Pray with Others
		</a>
		<br/>
		<a href="/prayers" title="Recent Confessions">
			Recent Prayers
		</a>
		<br/>
		<a href="/best_prayers" title="Popular Prayers">
			Top Prayers
		</a>
	</div>
	<div class="w33pc align-right">
		<b>More</b>
		<br/>
		<a href="/" title="<?= $meta['site_name'] ?>">
			<?= $meta['site_name'] ?>
		</a>
		<br/>
		<? if($_SERVER['REQUEST_URI'] === '/'){ ?>
			<a href="http://lifthousedesign.com" title="Austin Web Development" target="_blank">
				Web Design
			</a>
		<? }else{ ?>
			<a href="http://verses.com" title="Daily Bible Verses" target="_blank">
				Bible Verses
			</a>
		<? } ?>
		<br/>
		<a href="/contact" title="Contact <?= $meta['site_name'] ?>">
			Contact
		</a>
		<br/>
		<? if($logged_in){ ?>
			<a href="/authentication/log_out">Log Out</a><br/>
		<? }else{ ?>
			<!--a href="/authentication/log_in">Login</a--><br/>
		<? } ?>
	</div>
</div>