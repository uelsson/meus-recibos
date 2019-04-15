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
				    				<form method="post" action='{{ Request::segment(2) !== null ? "/client/".Request::segment(2) : "/client" }}'>
				    					{{ csrf_field() }}
				    					{{ Request::segment(2) !== null ? method_field('PUT') : '' }}
				    					<div class="form-row">
				    						<div class="form-group col-md-6">
												<label for="name">Nome</label>
												<input type="text" class="form-control" id="name" name="name" maxlength="150" autocomplete="off" value="{{isset($data->name) && $data->name !== null ? $data->name : ''}}"/>
				    						</div>

				    						<div class="form-group col-md-6">
												<label for="cpf">CPF</label>
												<input type="text" class="form-control cpf_mask" id="cpf" name="cpf" autocomplete="off" maxlength="14" placeholder="000.000.000-00" value="{{isset($data->cpf) && $data->cpf !== null ? $data->cpf : ''}}"/>
				    						</div>

				    						<div class="form-group col-md-6">
												<label for="phone">Telefone</label>
												<input type="text" class="form-control phone_mask" id="phone" name="phone" autocomplete="off" maxlength="15" placeholder="(00) 0 0000-0000" value="{{isset($data->phone) && $data->phone !== null ? $data->phone : ''}}"/>
				    						</div>

				    						<div class="form-group col-md-6">
												<label for="email">E-mail</label>
												<input type="text" class="form-control" id="email" name="email" autocomplete="off" maxlength="100" value="{{isset($data->email) && $data->email !== null ? $data->email : ''}}"/>
				    						</div>

				    						<div class="form-group col-md-12">
												<label for="note">Observações</label>
												<textarea class="form-control" id="note" name="note" rows="3" maxlength="2000">{{isset($data->note) && $data->note !== null ? $data->note : ''}}</textarea>
				    						</div>

				    						<div class="form-group col-md-12 text-right">
				    							<button type="submit" id="create_client" class="btn btn-primary">{{Request::segment(2) !== null ? 'Salvar' : 'Criar'}}</button>
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
