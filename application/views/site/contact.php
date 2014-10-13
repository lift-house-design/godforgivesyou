<div class="white-opac w700 pad20t pad40b pad40l pad40r pull-center mar40b">
	<div class="contact">
		<div class="center600">
			<h1 class="align-center">Contact Us</h1>
			<form id="contact-form" method="post">
				<input id="form-check" type="hidden" name="00<?= sha1(rand(0,time())) ?>" value=""/>
				<input type="text" name="name" placeholder="Name (first and last)" value="<?= $name ?>"/>
				<input type="text" name="phone" placeholder="Mobile Phone" value="<?= $phone ?>"/>
				<input type="text" name="email" placeholder="Email" value="<?= $email ?>"/>
				<textarea name="message" placeholder="How can we help you?" class="tall"><?= $message ?></textarea>
				<input type="submit" value="SEND"/>
			</form>
		</div>
	</div>
</div>