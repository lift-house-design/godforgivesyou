<div class="w700 pull-center align-center">
	<div class="white-opac w700 pad40">
		<? foreach($confessions as $c){ ?>
			<? view_confession($c); ?>
			<div class="spacer40"></div>
		<? } ?>
		<div class="w600 pull-center visible">
			<a href="" class="index-button">More Confessions</a>
		</div>
	</div>
</div>
<div class="spacer40"></div>