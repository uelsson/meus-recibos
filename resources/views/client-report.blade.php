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
				    				<form method="post" action='/client/csv'>
				    					{{ csrf_field() }}
				    					<div class="form-row">
				    						<div class="form-group col-md-6">
												<label for="month">Mês</label>
												<input type="text" class="form-control" id="month" name="month" autocomplete="off" maxlength="2" placeholder="Ex: 1 = Janeiro" value=""/>
				    						</div>

				    						<div class="form-group col-md-6">
												<label for="year">Ano</label>
												<input type="text" class="form-control" id="year" name="year" autocomplete="off" maxlength="4" placeholder="Ex: 2019" value=""/>
				    						</div>

				    						<div class="form-group col-md-12 text-right">
				    							<button type="submit" id="download_report" class="btn btn-primary">Baixar</button>
				    						</div>
				    					</div>
				    				</form><!-- ./form -->

						    	</div>
				    		</div><!-- ./col -->
		    			</div><!-- ./row -->
	    			</div>
	    		</div>
	    	</div><!-- ./container -->

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
				    				<div class="container">
					    			<!-- /row -->
						    		<div class="row list-head">
						    			<div class="col-md-1"><b>#</b></div>
						    			<div class="col-md-3"><b>Nome</b></div>
						    			<div class="col-md-2"><b>CPF</b></div>
						    			<div class="col-md-2"><b>Soma de recibos</b></div>
						    			<div class="col-md-4"><b>Ações</b></div>
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
							    			<div class="col-md-3">{{$result->name}}</div>
							    			<div class="col-md-2">{{$result->cpf}}</div>
							    			<div class="col-md-2">{{$result->amount}}</div>
							    			<div class="col-md-4">
							    				<a href="/client/{{$result->id}}/edit">Editar</a> /
							    				<form method="post" action="/client/{{$result->id}}" class="list-form">
							    					{{ method_field('DELETE') }}
   													{{ csrf_field() }}
							    					<button type="submit" class="btn-link">Deletar</button> /
							    				</form>
							    				<a href="/client/{{$result->id}}/receipt">+ Recibo</a> / 
							    				<a href="/receipt/{{$result->id}}">Recibos ({{$result->qt_receipts}})</a>
							    			</div>
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
