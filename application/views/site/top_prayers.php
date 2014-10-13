<div class="w700 pull-center align-center">
	<div class="white-opac w700 pad40">
		<? foreach($prayers as $p){ ?>
			<? view_prayer($p); ?>
			<div class="spacer40"></div>
		<? } ?>
	</div>
</div>
<div class="spacer40"></div>