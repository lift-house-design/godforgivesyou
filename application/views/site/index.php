<div id="homepage" class="w800 pull-center align-center">
	<h1 class="c8 robotob">Ask for Forgiveness</h1>
	<div class="white-opac w800 pad40">
		<div class="block w180 mar0r pull-left visible">
			<a class="index-button box-shadowed" href="/ask_for_forgiveness">ASK</a>
			<div class="box-shadowed" style="background:white;height:150px;width:180px;margin:9.5px 0;color:black">
				ad<br/>180x150
			</div>
			<a class="index-button box-shadowed" href="/forgive_sins">FORGIVE</a>
		</div>
		<a class="iblock w500 pull-right" href="/confession/<?= $confessions[0]['id'] ?>" title="<?= htmlspecialchars($confessions[0]['text']) ?>">
			<img class="w500" src="/image/confessions/<?= $confessions[0]['id'] ?>.png" alt="<?= htmlspecialchars($confessions[0]['text']) ?>"/>
		</a>
	</div>
	<div class="pad20"><img src="/assets/img/scroll.png" alt="transparent scroll down"/></div>
</div>
<div class="top-bordered bg8">
	<div class="w800 pull-center align-center pad40t pad40b pad20l pad20r">
		<? for($i=1; $i<4; $i++){ ?>
			<div class="iblock w240 f0">
				<a href="/confession/<?= $confessions[$i]['id'] ?>" title="<?= htmlspecialchars($confessions[$i]['text']) ?>">
					<img class="w240" src="/image/confessions/<?= $confessions[$i]['id'] ?>.png" alt="<?= htmlspecialchars($confessions[$i]['text']) ?>"/>
				</a>
			</div>
		<? } ?>
	</div>
	<div class="w800 pull-center align-right pad20r pad20b">
		<a href="/confessions"><img src="<?php echo asset('img/more-banner.png') ?>" alt="More" title="More" /></a>
	</div>
</div>
<div class="top-bordered bg3">
	<div class="w800 pull-center align-center pad40t pad40b pad20l pad20r">
		<div class="iblock w240 align-left">
			<a href="/ask_for_forgiveness">
				<img src="/assets/img/ask2.png" alt="Ask For Forgiveness"/>
			</a>
		</div>
		<div class="iblock w240 mar10l mar10r">
			<a href="/forgive_sins">
				<img src="/assets/img/help2.png" alt="Help Forgive Others"/>
			</a>
		</div>
		<div class="iblock w240 align-right">
			<a href="/pray_with_us">
				<img src="/assets/img/pray2.png" alt="Pray"/>
			</a>
		</div>
	</div>
</div>
<div class="bg8">
	<div class="w800 pull-center pad40t pad40b pad20l pad20r f16">
		<?= $content ?>
	</div>
</div>