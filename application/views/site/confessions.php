<div class="w700 pull-center align-center">
	<div class="white-opac w700 pad40">
		<? foreach($confessions as $c){ ?>
			<? view_confession($c); ?>
			<div class="spacer40"></div>
		<? } ?>
		<div class="w600 pull-center visible">
			<? if($prev){ ?>
				<a href="/confessions/<?= max(0, $start - $count) ?>" class="index-button pull-left w200">&larr; Newer</a>
			<? } ?>
			<? if($next){ ?>
				<a href="/confessions/<?= ($start + $count) ?>" class="index-button pull-right w200">Older &rarr;</a>
			<? } ?>
		</div>
	</div>
</div>
<div class="spacer40"></div>