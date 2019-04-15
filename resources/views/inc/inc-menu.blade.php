<!-- /section -->
<section class="menu">
	<!-- /container -->
	<div class="container">
		<!-- /row -->
		<div class="row">
			<!-- /col -->
			<div class="col-md-12">
				<ul>
					<li><a href="/" class="{{Request::is('/') ? 'active' : ''}}">Clientes</a></li>
					<li><a href="/client" class="{{Request::is('client') || Request::is('client/*/receipt') || Request::is('client/*/edit') || Request::is('receipt/*') ? 'active' : ''}}">Novo Cliente</a></li>
					
				</ul>
			</div><!-- ./col -->
		</div><!-- ./row -->
	</div><!-- ./container -->
</section><!-- ./section -->