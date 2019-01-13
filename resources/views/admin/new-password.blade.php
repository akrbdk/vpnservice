@extends('admin.layouts._layout')

@section('content')

	<main class="main-painel contato">
		<div class="container">
			<h2>Forgotten your password?</h2>

			<div class="table-base clearfix">
				<form class="clearfix" action="">
					<div class="password-label">
						<label for="password">New password</label>
						<input type="password"
							   name="password"
							   class="password"
							   placeholder="Insert your new password">
					</div>
					<div class="password-label">
						<label for="password2">Confirm your new password</label>
						<input type="password"
							   name="password2"
							   class="password"
							   placeholder="Confirm your new password">
					</div>

					<br style="clear:both;">
					<input type="submit" class="btn-orange" value="Confirm your new password">
				</form>
			</div>
		</div>
	</main>

@stop
