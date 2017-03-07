@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><a href="/clientes"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/clientes" class="hidden reload"><i class="icon-ccw-1"></i></a>
									<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
									<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
								</div>
							</div>
							@if(count(session('errors')) > 0)
									<div class="alert alert-danger">
											<ul>
													@foreach (session('errors') as $error)
															<li>{{ $error }}</li>
													@endforeach
											</ul>
									</div>
							@endif

							<div class="widget-content">

								<div class="widget-content padding">
									{{ Form::open(array('route' => 'clientes.store', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off')) }}
										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Cliente</label>
												<div class="col-sm-10">
													{{ Form::text('cliente', '', array('id' => 'cliente', 'name' => 'cliente', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese una cliente')) }}
												</div>
										</div>

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Barrio</label>
												<div class="col-sm-10">
													{{ Form::text('barrio', '', array('id' =>'barrio', 'name' =>'barrio', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese un barrio')) }}
													{{ Form::hidden('barrios_id', '', array('id' => 'barrios_id', 'name' => 'barrios_id')) }}
												</div>
										</div>

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Direccion</label>
												<div class="col-sm-10">
													{{ Form::text('direccion', '', array('id' => 'direccion', 'name' => 'direccion', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese una direcion')) }}
												</div>
										</div>

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Telefono</label>
												<div class="col-sm-10">
													{{ Form::text('telefono', '', array('id' => 'telefono', 'name' => 'telefono', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese un telefono de contacto')) }}
												</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Observaciones</label>
											<div class="col-sm-10">
											  <textarea class="summernote" id="observaciones" name="observaciones"></textarea>
											</div>
										</div>

										</div>
										<div class="widget-content padding">
											<div class="form-group">
												{{ Form::submit('Agregar', array('class' => 'btn btn-primary')) }}
											</div>
										</div>

										{{ Form::close() }}
								</div>


							</div>
						</div>
					</div>

				</div>

<script>
	var jq = jQuery.noConflict();
	jq(document).ready( function(){
		$("#barrio").autocomplete({
				source: "/barrios/search",
				select: function( event, ui ) {
					$('#barrios_id').val( ui.item.id );

				}
			});
		});
</script>


@stop
