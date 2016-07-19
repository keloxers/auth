@extends('layouts.app')

@section('content')


<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><a href="/devolucionesmotivos"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/devolucionesmotivos" class="hidden reload"><i class="icon-ccw-1"></i></a>
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
									{{ Form::open(array('route' => 'devolucionesmotivos.store', 'class' => 'form-horizontal', 'role' => 'form',  'autocomplete' => 'off')) }}
										<div class="form-group">
										<label for="input-text" class="col-sm-2 control-label">Motivo devolución</label>
												<div class="col-sm-10">
													{{ Form::text('devolucionesmotivo', '', array('id' => 'devolucionesmotivo', 'name' => 'devolucionesmotivo', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese un Motivo de devolución')) }}
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



@stop
