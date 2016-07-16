@extends('layouts.app')

@section('content')


<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><a href="/chofers"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/chofers" class="hidden reload"><i class="icon-ccw-1"></i></a>
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
									{{ Form::open(array('route' => 'chofers.store', 'class' => 'form-horizontal', 'role' => 'form',  'autocomplete' => 'off')) }}

										<div class="form-group">
												<label for="input-text" class="col-sm-2 control-label">Chofer</label>
												<div class="col-sm-10">
													{{ Form::text('chofer', '', array('id' => 'chofer', 'name' => 'chofer', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese una chofer')) }}
												</div>
											</div>


										<div class="form-group">
												<label for="input-text" class="col-sm-2 control-label">Dni</label>
												<div class="col-sm-10">
													{{ Form::text('dni', '', array('id' => 'dni', 'name' => 'dni', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese una dni')) }}
												</div>
											</div>

										<div class="form-group">
												<label for="input-text" class="col-sm-2 control-label">Estado</label>
												<div class="col-sm-10">
													<input type="checkbox" id="estado" name="estado" value="1" class="ios-switch ios-switch-success ios-switch-sm" checked />
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
