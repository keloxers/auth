@extends('layouts.app')

@section('content')


<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><a href="/condicionesventas"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/condicionesventas" class="hidden reload"><i class="icon-ccw-1"></i></a>
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
									{{ Form::open(array('url' => URL::to('condicionesventas/' . $condicionesventa->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
										<div class="form-group">
										<label for="input-text" class="col-sm-2 control-label">Condición de Venta</label>
												<div class="col-sm-10">
													{{ Form::text('condicionesventa', $condicionesventa->condicionesventa, array('class' => 'form-control input-lg', 'placeholder'
													 => 'Ingrese una condicionesventa')) }}
												</div>
											</div>
											<div class="form-group">
												<label for="input-text" class="col-sm-2 control-label">Porcentaje Entrega</label>
												<div class="col-sm-4">
													{{ Form::text('porcentaje_entrega', $condicionesventa->porcentaje_entrega, array('id' => 'porcentaje_entrega', 'name' => 'porcentaje_entrega', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese porcentaje entrega')) }}
												</div>
											</div>
											<div class="form-group">
												<label for="input-text" class="col-sm-2 control-label">Cuotas</label>
												<div class="col-sm-4">
													{{ Form::text('cuotas', $condicionesventa->cuotas, array('id' => 'cuotas', 'name' => 'cuotas', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese cantidad de cuotas')) }}
												</div>
											</div>
											<div class="form-group">
												<label for="input-text" class="col-sm-2 control-label">Interes sobre el saldo</label>
												<div class="col-sm-4">
													{{ Form::text('interes', $condicionesventa->interes, array('id' => 'interes', 'name' => 'interes', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese interes a aplicar sobre el saldo')) }}
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





@stop
