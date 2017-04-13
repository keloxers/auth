@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><a href="/ventas"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/ventas" class="hidden reload"><i class="icon-ccw-1"></i></a>
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
									{{ Form::open(array('url' => URL::to('ventas/' . $venta->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
									{{ Form::hidden('ventas_id', $venta->id, array('id' => 'ventas_id', 'name' => 'ventas_id')) }}
										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Cliente</label>
												<div class="col-sm-10">
													{{ Form::text('cliente', $cliente->cliente, array('id' =>'cliente', 'name' =>'cliente', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese cliente')) }}
													{{ Form::hidden('clientes_id', $venta->clientes_id, array('id' => 'clientes_id', 'name' => 'clientes_id')) }}
												</div>
										</div>

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Deposito</label>
												<div class="col-sm-10">
													{{ Form::text('deposito', $deposito->deposito, array('id' =>'deposito', 'name' =>'deposito', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese deposito')) }}
													{{ Form::hidden('depositos_id', $venta->depositos_id, array('id' => 'depositos_id', 'name' => 'depositos_id')) }}
												</div>
										</div>

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Condicion Venta</label>
												<div class="col-sm-10">
													{{ Form::text('condicionesventa', $condicionesventa->condicionesventa, array('id' =>'condicionesventa', 'name' =>'condicionesventa', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese condicione de venta')) }}
													{{ Form::hidden('condicionesventas_id', $venta->condicionesventas_id, array('id' => 'condicionesventas_id', 'name' => 'condicionesventas_id')) }}
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
							$("#cliente").autocomplete({
									source: "/clientes/search",
									select: function( event, ui ) {
										$('#clientes_id').val( ui.item.id );

									}
								});
							});
							jq(document).ready( function(){
								$("#deposito").autocomplete({
										source: "/depositos/search",
										select: function( event, ui ) {
											$('#depositos_id').val( ui.item.id );

										}
									});
								});
								jq(document).ready( function(){
									$("#condicionesventa").autocomplete({
											source: "/condicionesventas/search",
											select: function( event, ui ) {
												$('#condicionesventas_id').val( ui.item.id );

											}
										});
									});
					</script>



@stop
