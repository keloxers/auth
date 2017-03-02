@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-header transparent">
				<h2><strong>{{ $title}}</h2>
					<div class="additional-btn">
						<a href="/proveedors" class="hidden reload"><i class="icon-ccw-1"></i></a>
						<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
						<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
					</div>
				</div>
				<div class="widget-content">
					<div class="data-table-toolbar">
						<div class="row">
							<div class="col-md-4">
								{{ Form::open(array('route' => 'proveedors.finder')) }}
								<input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar...">
								{{ Form::close() }}
							</div>
							<div class="col-md-8">
								<div class="toolbar-btn-action">
									<a href="/proveedors/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nuevo</a>
								</div>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table data-sortable class="table table-hover table-striped">
							<thead>
								<tr>
									<th><div align="center">Proveedor</div></th>
									<th><div align="center">Cuit</div></th>
									<th><div align="center">Acción</div></th>
								</tr>
							</thead>

							<tbody>
								@if ($proveedors)
								@foreach ($proveedors as $proveedor)
								<tr>
									<td>{{ $proveedor->proveedor }}</td>
									<td>{{ $proveedor->cuit }}</td>
									<td>
										<div align="center">
											<a href='/proveedors/{{ $proveedor->id }}/edit'>
												<span class="label label-primary">Editar</span>
											</a>
											<a href='/proveedors/{{ $proveedor->id }}'>
												<span class="label label-default">Ver</span>
											</a>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
							@endif
						</table>
					</div>

					<div class="data-table-toolbar">
						{{ $proveedors->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>

	@stop
