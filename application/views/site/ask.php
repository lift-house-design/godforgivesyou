<script>
$(function() {
	$('.bg-buffet').slick({
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 3
	});

	$('.bg-buffet div img').click(function(){
		$('.bg-buffet div img').removeClass('active');
		$(this).addClass('active');
		$('.ask-box').css('background','url('+$(this).attr('data-src')+')');
	});

	$('.confession-submission').click(function(){
		if(<?= json_encode($logged_in) ?>)
			submit_confession();
		else
			signup_form(
				'Receive notifications from our spiritual counselors and join our community.',
				submit_confession,
				true
			);
	});
});
</script>

<div class="w700 pull-center align-center">
	<h1 class="c8 robotob">Ask for Forgiveness</h1>
	<div class="white-opac w700 pad40">
		<div class="bg-buffet visible">
			<? foreach($backgrounds as $bg){ ?>
				<div>
					<img src="/assets/img/bgs/thumb/<?= $bg['file'] ?>" data-id="<?= $bg['id'] ?>" data-src="/assets/img/bgs/<?= $bg['file'] ?>"/>
				</div>
			<? } ?>
		</div>
		<div class="ask-box">
			<textarea placeholder="What are you sins, my child?" maxlength="700"></textarea>
		</div>
		<div class="ask-errors hide">

		</div>
		<a class="confession-submission" href="javascript:void(0)">Submit Confession</a>
	</div>
</div>
<div class="spacer40"></div>
<div class="top-bordered bg8">
	<div class="w700 pull-center align-center pad40">
		<h2>Recent Confessions</h2>
		<div class="spacer20"></div>
		<? foreach($confessions as $c){ ?>
			<? view_confession($c); ?>
			<div class="spacer40"></div>
		<? } ?>
		<div class="visible">
			<a class="index-button w600 pull-center" href="/confessions" title="Confessions">More Confessions</a>
		</div>
	</div>
</div>