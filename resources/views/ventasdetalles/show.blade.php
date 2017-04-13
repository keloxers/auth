@extends('layouts.app')

@section('content')


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
							<div class="widget-content">

								<div class="widget-content padding">
									{{ Form::open(array('url' => '/comprasdetalles/' . $comprasdetalle->id, 'class' => 'form-horizontal')) }}
									{{ Form::hidden('_method', 'DELETE') }}



									{{ Form::hidden('compras_id', $compra->id, array('id' => 'compras_id', 'name' => 'compras_id')) }}

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Deposito</label>
												<div class="col-sm-10">
													{{ $deposito->deposito }}
												</div>
										</div>

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Cantidad</label>
												<div class="col-sm-3">
													{{ $comprasdetalle->cantidad }}
												</div>
										</div>

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Articulo</label>
												<div class="col-sm-10">
													{{ $articulo->articulo }}
												</div>
										</div>

										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label">Precio de Costo</label>
												<div class="col-sm-3">
													{{ $comprasdetalle->precio_costo }}
												</div>
										</div>




										</div>
										<div class="widget-content padding">
											<div class="form-group">
												{{ Form::submit('Eliminar', array('class' => 'btn btn-warning')) }}
												{{ Form::close() }}
											</div>
										</div>

								</div>


							</div>
						</div>
					</div>


@stop
