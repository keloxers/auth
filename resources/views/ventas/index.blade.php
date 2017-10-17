@extends('layouts.app')

@section('content')

<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/ventas" class="hidden reload"><i class="icon-ccw-1"></i></a>
									<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
									<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
								</div>
							</div>
							<div class="widget-content">
								<div class="data-table-toolbar">
									<div class="row">
										<div class="col-md-4">
											{{ Form::open(array('route' => 'ventas.finder')) }}
											<input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar...">
											{{ Form::close() }}
										</div>
										<div class="col-md-8">
											<div class="toolbar-btn-action">
												<a href="/ventas/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nueva</a>
											</div>
										</div>
									</div>
								</div>




								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped">
										<thead>
											<tr>
												<th>Fecha</th>
												<th>Cliente</th>
												<th>Total</th>
												<th>Estado</th>
												<th>Acción</th>
											</tr>
										</thead>

										<tbody>
											@if ($ventas)
											@foreach ($ventas as $venta)
											<tr>
												<td>{{ $venta->created_at }}</td>
												<td>{{ $venta->clientes->cliente }}</td>
												<td>{{ $venta->total }}</td>
												<td>{{ $venta->estado }}</td>
												<td>
													<a href='/ventasdetalles/{{ $venta->id }}'>
														<span class="label label-primary">Detalle</span>
													</a>
													<a href='/ventas/{{ $venta->id }}/edit'>
														<span class="label label-info">Edit</span>
													</a>
												</td>
											</tr>
											@endforeach
										</tbody>
										@endif
									</table>
								</div>

								<div class="data-table-toolbar">
									{{ $ventas->links() }}
								</div>
							</div>
						</div>
					</div>

				</div>


@stop
