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
				    				<form method="post" action='/client/{{Request::segment(2)}}/receipt' enctype="multipart/form-data">
				    					{{ csrf_field() }}
				    					<input type="hidden" name="client_id" id="client_id" value="{{Request::segment(2)}}">
				    					<div class="form-row">
				    						<div class="form-group col-md-3">
												<label for="amount">Montante</label>
												<input type="text" class="form-control money_mask" id="amount" name="amount" autocomplete="off" maxlength="17" placeholder="0"/>
				    						</div>

				    						<div class="form-group col-md-3">
												<label for="dt_receipt">Dt Depósito</label>
												<input type="text" class="form-control date_mask" id="dt_receipt" name="dt_receipt" autocomplete="off" placeholder="DD/MM/YYYY"/>
				    						</div>

				    						<div class="form-group col-md-6">
				    							<label>Recibo (PDF, PNG, JPG)</label>
				    							<div class="input-group">
													
													<input type="file" class="custom-file-input" name="receipt_file" id="receipt_file">
													<label class="custom-file-label file_selected" for="receipt_file">Escolha o recibo</label>
												
												</div>
											</div>

				    						<div class="form-group col-md-12 text-right">
				    							<button type="submit" id="create_receipt" class="btn btn-primary">Criar</button>
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
