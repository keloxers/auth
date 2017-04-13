@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><a href="/articuloscategorias"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/articuloscategorias" class="hidden reload"><i class="icon-ccw-1"></i></a>
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
									{{ Form::open(array('url' => URL::to('comprasdetalles/' . $comprasdetalle->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}


									{{ Form::hidden('compras_id', $compra->id, array('id' => 'compras_id', 'name' => 'compras_id')) }}

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Deposito</label>
												<div class="col-sm-10">
													{{ Form::text('deposito', $deposito->deposito, array('id' =>'deposito', 'name' =>'deposito', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese un deposito')) }}
													{{ Form::hidden('depositos_id', $comprasdetalle->depositos_id, array('id' => 'depositos_id', 'name' => 'depositos_id')) }}
												</div>
										</div>

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Cantidad</label>
												<div class="col-sm-3">
													{{ Form::text('cantidad', $comprasdetalle->cantidad, array('id' =>'cantidad', 'name' =>'cantidad', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese cantidad')) }}
												</div>
										</div>

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Articulo</label>
												<div class="col-sm-10">
													{{ Form::text('articulo', $articulo->articulo, array('id' =>'articulo', 'name' =>'articulo', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese un articulo')) }}
													{{ Form::hidden('articulos_id', $comprasdetalle->articulos_id, array('id' => 'articulos_id', 'name' => 'articulos_id')) }}
												</div>
										</div>

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Precio de Costo</label>
												<div class="col-sm-3">
													{{ Form::text('precio_costo', $comprasdetalle->precio_costo, array('id' =>'precio_costo', 'name' =>'precio_costo', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese precio costo')) }}
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
							$("#deposito").autocomplete({
									source: "/depositos/search",
									select: function( event, ui ) {
										$('#depositos_id').val( ui.item.id );

									}
								});
							});

							jq(document).ready( function(){
								$("#articulo").autocomplete({
										source: "/articulos/search",
										select: function( event, ui ) {
											$('#articulos_id').val( ui.item.id );

										}
									});
								});

					</script>




@stop
