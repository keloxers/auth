@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-header transparent">
				<h2><strong>{{ $title}}</h2>
					<div class="additional-btn">
						<a href="/articulos" class="hidden reload"><i class="icon-ccw-1"></i></a>
						<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
						<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
					</div>
				</div>
				<div class="widget-content">
					<div class="data-table-toolbar">
						<div class="row">
							<div class="col-md-4">
								{{ Form::open(array('route' => 'articulos.finder')) }}
								<input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar...">
								{{ Form::close() }}
							</div>
							<div class="col-md-8">
								<div class="toolbar-btn-action">
									<a href="/articulos/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nuevo</a>
								</div>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table data-sortable class="table table-hover table-striped">
							<thead>
								<tr>
									<th><div align="center">Articulo</div></th>
									<th><div align="center">Precio al Publico</div></th>
									<?php $depositos = App\Deposito::all(); ?>
									@if ($depositos)
										@foreach ($depositos as $deposito)
											<th><div align="center">{{ $deposito->deposito}}</div></th>
										@endforeach
									@endif


									<th><div align="center">Acción</div></th>
								</tr>
							</thead>

							<tbody>
								@if ($articulos)
								@foreach ($articulos as $articulo)
								<tr>
									<td>{{ $articulo->articulo }}</td>
									<td><div align="right">{{ $articulo->precio_publico }}</div></td>

									@if ($depositos)
										@foreach ($depositos as $deposito)
											<?php
												$stock = DB::table('stocks')
																		->where('depositos_id', $deposito->id)
																		->where('articulos_id', $articulo->id)
																		->value('stock');
												if ($stock==null) {
													$stock=0;
												}
											?>
											<th><div align="center">{{ $stock }}</div></th>
										@endforeach
									@endif


									<td>
										<div align="center">
											<a href='/articulos/{{ $articulo->id }}/edit'>
												<span class="label label-primary">Editar</span>
											</a>
											<a href='/articulos/{{ $articulo->id }}'>
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
						{{ $articulos->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>

	@stop
