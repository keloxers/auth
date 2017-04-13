@extends('layouts.app')

@section('content')

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

							<div class="widget-content">
								<div class="data-table-toolbar">
									<div class="row">
										<div class="col-md-4">
											{{ Form::open(array('route' => 'ventasdetalles.finder')) }}
											<input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar...">
											{{ Form::close() }}
										</div>
										<div class="col-md-8">
											@if ($venta->estado=='abierta')
											<div class="toolbar-btn-action">
												<a href="/ventasdetalles/{{ $venta->id }}/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nueva</a>
											</div>
											@endif
										</div>
									</div>
								</div>

								<?php $total = 0; ?>


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
													<a href='/ventasdetalles/{{ $ventasdetalle->id }}/edit'>
														<span class="label label-primary">Editar</span>
													</a>
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







@stop
