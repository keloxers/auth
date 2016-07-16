@extends('layouts.app')

@section('content')

<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/chofers" class="hidden reload"><i class="icon-ccw-1"></i></a>
									<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
									<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
								</div>
							</div>
							<div class="widget-content">
								<div class="data-table-toolbar">
									<div class="row">
										<div class="col-md-4">
											{{ Form::open(array('route' => 'chofers.finder')) }}
											<input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar...">
											{{ Form::close() }}
										</div>
										<div class="col-md-8">
											<div class="toolbar-btn-action">
												<a href="/chofers/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nuevo</a>
											</div>
										</div>
									</div>
								</div>

								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped">
										<thead>
											<tr>
												<th>Chofer</th>
												<th>Dni</th>
												<th>Estado</th>
												<th>Acción</th>
											</tr>
										</thead>

										<tbody>
											@if ($chofers)
											@foreach ($chofers as $chofer)
											<tr>
												<td>{{ $chofer->chofer }}</td>
												<td>{{ $chofer->dni }}</td>
												<td>
													@if ($chofer->estado)
															<p class="text-success">Activo</p>
													@else
															<p class="text-danger">Inactivo</p>														
													@endif
												</td>
												<td>
													<a href='/chofers/{{ $chofer->id }}/edit'>
														<span class="label label-primary">Editar</span>
													</a>
													<a href='/chofers/{{ $chofer->id }}'>
													<span class="label label-default">Ver</span>
													</a>
												</td>
											</tr>
											@endforeach
										</tbody>
										@endif
									</table>
								</div>

								<div class="data-table-toolbar">
									{{ $chofers->links() }}
								</div>
							</div>
						</div>
					</div>

				</div>







@stop
