<!doctype html>
<html lang="en">
	@include('inc/inc-head')

	<body>
	    @include('inc/inc-menu')
	    		
	    <!-- /section -->
	    <section class="system">
	    	<!-- /container -->
	    	<div class="container box-system">
	    		<div class="row">
	    			<div class="col-md-12">
	    				<!-- /container -->
			    		<div class="container bg-color-white">
				    		<!-- /row -->
				    		<div class="row ">
				    			<!-- /col -->
				    			<div class="col-md-12">
				    				@if(session('messageError') !== null)
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											{{session('messageError')}}
											
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									@endif

				    				<div class="container">
						    			<!-- /row -->
							    		<div class="row list-head">
							    			<div class="col-md-1"><b>#</b></div>
							    			<div class="col-md-3"><b>Criado em</b></div>
							    			<div class="col-md-2"><b>Data</b></div>
							    			<div class="col-md-3"><b>Valor do recibo</b></div>
							    			<div class="col-md-3"><b>Ação</b></div>
							    		</div><!-- ./row -->
						    		</div>
					    		</div><!-- ./col -->
			    			</div><!-- ./row -->
			    		</div>

	    		
			    		<!-- /container -->
			    		<div class="container bg-color-white padding-botton">
			    			<!-- /row -->
			    			<div class="row">
				    			<div class="col-md-12">
				    				<div class="container">
					    				@foreach($results as $result)
						    				<div class="row list-body">
								    			<div class="col-md-1">{{$result->id}}</div>
								    			<div class="col-md-3">{{date('d/m/Y H:i:s', strtotime($result->dt_created))}}</div>
								    			<div class="col-md-2">{{date('d/m/Y', strtotime($result->dt_receipt))}}</div>
								    			<div class="col-md-3">{{$result->amount}}</div>
								    			<div class="col-md-3"><a href="/receipt/{{Request::segment(2)}}/{{$result->id}}">Baixar</a></div>
							    			</div>
						    			@endforeach
					    			</div>
				    			</div>
			    			</div><!-- ./row -->
			    		</div><!-- ./container -->
	    			</div>
	    		</div>
	    	</div><!-- ./container -->
	    </section><!-- ./section -->

	    @include('inc/inc-js')
	</body>
</html>
