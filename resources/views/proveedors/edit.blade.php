@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><a href="/proveedors"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/proveedors" class="hidden reload"><i class="icon-ccw-1"></i></a>
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
									{{ Form::open(array('url' => URL::to('/proveedors/' . $proveedor->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}



									<div class="form-group">
										<label for="input-text" class="col-sm-2 control-label">Proveedor</label>
										<div class="col-sm-7">
											{{ Form::text('proveedor', $proveedor->proveedor, array('id' => 'proveedor', 'name' => 'proveedor', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese una proveedor')) }}
										</div>
									</div>

									<div class="form-group">
										<label for="input-text" class="col-sm-2 control-label">Domicilio Fiscal</label>
										<div class="col-sm-10">
											{{ Form::text('domicilio_fiscal', $proveedor->domicilio_fiscal, array('id' => 'domicilio_fiscal', 'name' => 'domicilio_fiscal', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese Domicilio Fiscal')) }}
										</div>
									</div>

									<div class="form-group">
										<label for="input-text" class="col-sm-2 control-label">Cuit</label>
										<div class="col-sm-3">
											{{ Form::text('cuit', $proveedor->cuit, array('id' => 'cuit', 'name' => 'cuit', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese un cuit sin guiones')) }}
										</div>
									</div>

									<div class="form-group">
										<label for="input-text" class="col-sm-2 control-label">Tipo Iva</label>
										<div class="col-sm-5">
											{{ Form::text('tipoiva', $tipoiva->tipoiva, array('id' =>'tipoiva', 'name' =>'tipoiva', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese un tipoiva')) }}
											{{ Form::hidden('tipoivas_id', $proveedor->tipoivas_id, array('id' => 'tipoivas_id', 'name' => 'tipoivas_id')) }}
										</div>
									</div>

									<div class="form-group">
										<label for="input-text" class="col-sm-2 control-label">Telefono</label>
										<div class="col-sm-4">
											{{ Form::text('telefono', $proveedor->telefono, array('id' => 'telefono', 'name' => 'telefono', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese telefono')) }}
										</div>
									</div>




										</div>
										<div class="widget-content padding">
											<div class="form-group">
												{{ Form::submit('Modificar', array('class' => 'btn btn-primary')) }}
											</div>
										</div>

								</div>


							</div>
						</div>
					</div>


					<script>
					var jq = jQuery.noConflict();
					jq(document).ready( function(){
						$("#tipoiva").autocomplete({
							source: "/tipoivas/search",
							select: function( event, ui ) {
								$('#tipoivas_id').val( ui.item.id );
							}
						});
					});
					</script>


@stop
