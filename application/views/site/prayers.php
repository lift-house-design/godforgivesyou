<div class="w700 pull-center align-center">
	<div class="white-opac w700 pad40">
		<?php if(empty($prayers)): ?>
			<p>There are currently no prayers to show.</p>
		<?php else: ?>
			<? foreach($prayers as $p){ ?>
				<? view_prayer($p); ?>
				<div class="spacer40"></div>
			<? } ?>

			<div class="w600 pull-center visible">
				<? if($prev){ ?>
					<a href="/prayers/<?= max(0, $start - $count) ?>" class="index-button pull-left w200">&larr; Newer</a>
				<? } ?>
				<? if($next){ ?>
					<a href="/prayers/<?= ($start + $count) ?>" class="index-button pull-right w200">Older &rarr;</a>
				<? } ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<div class="spacer40"></div>