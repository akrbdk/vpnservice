@extends('site.layouts._layout')

@section('content')

	<main class="main-painel invite-friend">
		<div class="container">
			<h2>INVITATION</h2>

			<div class="table-base clearfix">
				<h3 class="title">Invite a friend</h3>
				<p class="desc">You and your friend gets 1 month free if your friend register :D</p>

				<form class="clearfix" action="">
					<input type="email" name="email" class="email" placeholder="Type your friend's email">
					<input type="submit" class="btn-orange" value="Invite by email">
				</form>

				<div class="cpy-ref clearfix">
					<input type="text"
						   name="cupy"
						   class="cpy-ref"
						   value="http://speedvpn.com/invite-ref?0127" readonly>
					<button class="btn-orange btn-cpy"
							data-clipboard-action="copy"
							data-clipboard-target=".cpy-ref">
						Copy my referral link
					</button>
				</div>

				<h3 class="title-invite">Your invitations</h3>
				<ul id="invite-stats">
					<li><span>21</span>Invites<br />by email</li>
					<li><span>61</span>Your indication's<br />access</li>
					<li><span>3</span>Registered<br />friends</li>
					<li><span>90</span>Bonus days<br />won</li>
				</ul>
			</div>

			<img class="bg-bl" src="{{ asset('/img/bg-bl.png') }}" alt="">
		</div>
	</main>


@stop