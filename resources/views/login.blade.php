<!doctype html>
<html lang="en">
	@include('inc/inc-head')

	<body>	    		
	    <!-- /section -->
	    <section class="system">
	    	<!-- /container -->
	    	<div class="container box-system">
	    		<div class="row justify-content-center">
	    			<div class="col-md-6">
	    				<div class="container bg-color-white">
	    					<!-- /row -->
				    		<div class="row">
				    			<div class="col-md-12">
				    				@if($errors->all())
										<div class="alert alert-warning alert-dismissible fade show" role="alert">
											@foreach($errors->all() as $error)
												<div>{{ $error }}</div>
											@endforeach
											
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									@endif

									@if(session('messageSuccess') !== null)
										<div class="alert alert-success alert-dismissible fade show" role="alert">
											{{session('messageSuccess')}}
											
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									@endif

									@if(session('messageError') !== null)
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											{{session('messageError')}}
											
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									@endif

				    				<!-- /form -->
				    				<form method="post" action='/login'>
				    					{{ csrf_field() }}
				    					<div class="form-row">
				    						<div class="form-group col-md-12">
												<label for="email">E-mail</label>
												<input type="text" class="form-control" id="email" name="email" autocomplete="off" maxlength="150"/>
				    						</div>

				    						<div class="form-group col-md-12">
												<label for="password">Senha</label>
												<input type="password" class="form-control" id="password" name="password" autocomplete="off" maxlength="80"/>
				    						</div>

				    						<div class="form-group col-md-12 text-right">
				    							<button type="submit" id="login" class="btn btn-primary">Entrar</button>
				    						</div>
				    					</div>
				    				</form><!-- ./form -->
				    			</div>
				    		</div><!-- ./row -->
	    				</div>
	    			</div>
	    		</div>
	    	</div><!-- ./container -->
	    </section><!-- ./section -->

	    @include('inc/inc-js')
	</body>
</html>
