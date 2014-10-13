<div class="w700 pull-center align-center">
	<div class="white-opac w700 pad40">
		<? view_confession($confession); ?>
		<div class="w600 pull-center visible">
			<? if($prev){ ?>
				<a href="/confession/<?= $prev ?>" class="index-button pull-left w200">&larr; Previous</a>
			<? } ?>
			<? if($next){ ?>
				<a href="/confession/<?= $next ?>" class="index-button pull-right w200">Next &rarr;</a>
			<? } ?>
		</div>
	</div>
</div>
<div class="spacer40"></div>
<div class="top-bordered bg8">
	<div class="w800 pull-center pad40t pad40b pad20l pad20r">
		<h2>Confession</h2>
		<h3><?= nl2br(htmlspecialchars($confession['text'])) ?></h3>
	</div>
</div>