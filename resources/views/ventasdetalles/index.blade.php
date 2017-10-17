@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>



<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>{{ $title}}: {{ $venta->clientes->cliente }}</h2>
								<div class="additional-btn">
									<a href="/ventasdetalles" class="hidden reload"><i class="icon-ccw-1"></i></a>
									<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
									<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
								</div>
							</div>



								<?php $total = 0; ?>


															<div class="widget-content">

																<div class="widget-content padding">
																	{{ Form::open(array('route' => 'ventasdetalles.store', 'class' => 'form-horizontal', 'role' => 'form',  'autocomplete' => 'off')) }}

																	{{ Form::hidden('ventas_id', $venta->id, array('id' => 'ventas_id', 'name' => 'ventas_id')) }}


																		<div class="form-group">
																			<div class="col-sm-2">
																				Cantidad:
																				{{ Form::text('cantidad', '1', array('id' =>'cantidad', 'name' =>'cantidad', 'class' => 'form-control input-lg', 'placeholder' => '1')) }}
																			</div>
																				<div class="col-sm-8">
																					Articulo{{ Form::text('articulo', '', array('id' =>'articulo', 'name' =>'articulo', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese un articulo')) }}
																					{{ Form::hidden('articulos_id', '', array('id' => 'articulos_id', 'name' => 'articulos_id')) }}
																				</div>
																				<div class="col-sm-2">
																					{{ Form::submit('Agregar', array('class' => 'btn btn-primary')) }}
																				</div>

																		</div>

																		</div>

																		{{ Form::close() }}
																</div>


								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped">
										<thead>
											<tr>
												<th>Cantidad</th>
												<th>Articulo</th>
												<th>Precio Unitario</th>
												<th>Precio Total</th>
												<th>Acción</th>
											</tr>
										</thead>

										<tbody>

											@if ($ventasdetalles)
											@foreach ($ventasdetalles as $ventasdetalle)
											<tr>

												<td>{{ $ventasdetalle->cantidad }}</td>
												<td>{{ $ventasdetalle->articulos->articulo }}</td>
												<td>{{ $ventasdetalle->precio_unitario }}</td>
												<td>{{ $ventasdetalle->precio_total }}</td>
												<?php
													$total += $ventasdetalle->precio_total;
												 ?>
												<td>
													@if ($venta->estado=='abierta')
													<a href='/ventasdetalles/{{ $ventasdetalle->id }}/delete'>
														<span class="label label-danger">Eliminar</span>
													</a>
													@endif
												</td>
											</tr>
											@endforeach
										</tbody>
										@endif
									</table>
								</div>

								<?php

												$valorcuotas = 0;

												if ($venta->entrega == 0 ) {
														$entrega = $total;
														if ($condicionesventa->porcentaje_entrega > 0)
														{
															$entrega = $total * $condicionesventa->porcentaje_entrega / 100;
														} else {
															$entrega = $total;
														}

												} else {
														$entrega = $venta->entrega;
												}

												if ($total > 0 and $condicionesventa->cuotas > 0) {
														$resto = $total - $entrega;
														$resto = $resto + ( $resto * $condicionesventa->interes / 100);
														$valorcuotas = ceil($resto / $condicionesventa->cuotas);
												}

								?>

								<div class="data-table-toolbar">
									<div class="row">
										<div class="col-md-3">
											Total
										</div>
										<div class="col-md-3">
											Entrega
										</div>
										<div class="col-md-3">
											Cuotas restantes
										</div>
										<div class="col-md-3">
											Valor de Cuotas
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											{{ $total }}
										</div>
										<div class="col-md-3">
											@if ($venta->estado=='abierta')
												{{ Form::open(array('route' => 'ventasdetalles.calcular', 'class' => 'form-horizontal', 'role' => 'form',  'autocomplete' => 'off')) }}
												{{ Form::hidden('ventas_id', $venta->id, array('id' => 'ventas_id', 'name' => 'ventas_id')) }}
												{{ Form::text('entrega', number_format($entrega, 2, '.', ' '), array('id' =>'entrega', 'name' =>'entrega', 'class' => 'form-control input-lg', 'placeholder' => number_format($entrega, 2, '.', ' '))) }}
												{{ Form::submit('Calcular', array('class' => 'btn btn-primary')) }}
												{{ Form::close() }}
											@else
												{{ $condicionesventa->entrega }}
											@endif
										</div>
										<div class="col-md-3">
											{{ $condicionesventa->cuotas }}
										</div>
										<div class="col-md-3">
												{{ number_format($valorcuotas, 2, '.', ' ')}}
										</div>
									</div>

								</div>

								<div class="data-table-toolbar">
									<div class="row">
										<div class="col-md-4">
										</div>
										<div class="col-md-8">
											@if ($venta->estado=='abierta')
											<div class="toolbar-btn-action">
												<a href="/ventas/{{ $venta->id }}/close" class="btn btn-success"><i class="icon-basket-1"></i> Cerrar</a>
											</div>
											@endif
										</div>
									</div>
								</div>

								<div class="data-table-toolbar">
									{{ $ventasdetalles->links() }}
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
