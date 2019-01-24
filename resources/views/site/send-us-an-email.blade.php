@extends('site.layouts._layout')

@section('content')

	<main class="main-painel entre-contato">
		<div class="container">
			<h2>Send an email to us</h2>
			<div class="table-base clearfix">
				<form id="contactform" method="POST" class="clearfix validateform" action="" enctype="multipart/form-data">

					{{ csrf_field() }}

					<div id="sendmessage" style="display: none" class="clearfix">
						Ваше сообщение отправлено!
					</div>
					<div id="senderror" style="display: none" class="clearfix">
						Ваше сообщение отправлено!
					</div>
					<?/*<div id="senderror" style="display: none" class="clearfix">
						При отправке сообщения произошла ошибка. Продублируйте его, пожалуйста, на почту администратора <span>{{ env('MAIL_ADMIN_EMAIL') }}</span>
					</div>*/?>


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
						<div class="g-recaptcha" data-sitekey="6LfKh4IUAAAAAGA3yo7qkblWIFXg3_WUGXJTuovW" data-callback="someFunctionName"></div>
						{{--<script>function someFunctionName(){--}}
                                {{--$('#button1').removeAttr('disabled');--}}
                            {{--}</script>--}}
					</div>
					<span style="margin-bottom: 20px" class="container"></span>
					<input disabled="disabled" type="submit" id="button1" class="btn-orange" value="SEND">
				</form>

			</div>
		</div>
	</main>

@stop
