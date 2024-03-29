@extends('site.layouts._layout')

@section('content')
	<div id='sendmessage' style='display:none'>
		<div class="alert-success modal-content recovery-pw" style="display: block;">
				<h2 class='errtext'>Email wasn't send</h2>
				<button type="button" class="modal-close btn-green">Ok</button>
		</div>
		<div class="modal" style="display: block;"></div>
	</div>

	<main class="main-painel entre-contato">
		<div class="container">
			<h2>Send an email to us</h2>
			<div class="table-base clearfix">
				<form id="contactform" method="POST" class="clearfix validateform" action="" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="email-label">
						<label for="email">Email</label>
						<input type="email" name="email" class="email" placeholder="We will answer to this email" required>
					</div>
					<div class="anexo-label">
						<label for="file">Attachment</label>
						<input type="file" name="file" class="custom-file-input">
					</div>
					<div class="message">
						<label for="message">Message</label>
						<textarea name="message" id="message"></textarea>
					</div>

					<div class="clearfix">
						<div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_SITEKEY') }}" data-callback="someFunctionName"></div>
						<script>function someFunctionName(){
                                $('#button1').removeAttr('disabled');
                            }</script>
					</div>
					<span style="margin-bottom: 20px" class="container"></span>
					<input disabled="disabled" type="submit" id="button1" class="btn-orange" value="SEND">
				</form>

			</div>
		</div>
	</main>

@stop
