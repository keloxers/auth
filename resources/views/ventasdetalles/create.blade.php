@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>



<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">

								<h2><a href="/ventasdetalles/{{$venta->id}}"><i class="icon-left"></i></a> <strong>{{ $title }}: {{$venta->clientes->cliente}}</h2>

								<div class="additional-btn">
									<a href="/ventasdetalles/{{$venta->id}}" class="hidden reload"><i class="icon-ccw-1"></i></a>
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
									{{ Form::open(array('route' => 'ventasdetalles.store', 'class' => 'form-horizontal', 'role' => 'form',  'autocomplete' => 'off')) }}

									{{ Form::hidden('ventas_id', $venta->id, array('id' => 'ventas_id', 'name' => 'ventas_id')) }}

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Cantidad</label>
												<div class="col-sm-3">
													{{ Form::text('cantidad', '', array('id' =>'cantidad', 'name' =>'cantidad', 'class' => 'form-control input-lg', 'placeholder' => '1')) }}
												</div>
										</div>

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Articulo</label>
												<div class="col-sm-10">
													{{ Form::text('articulo', '', array('id' =>'articulo', 'name' =>'articulo', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese un articulo')) }}
													{{ Form::hidden('articulos_id', '', array('id' => 'articulos_id', 'name' => 'articulos_id')) }}
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
							$("#articulo").autocomplete({
									source: "/articulos/search",
									select: function( event, ui ) {
										$('#articulos_id').val( ui.item.id );

									}
								});
							});

				</script>


@stop
