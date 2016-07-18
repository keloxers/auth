@extends('layouts.app')

@section('content')


<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><a href="/depositos"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/depositos" class="hidden reload"><i class="icon-ccw-1"></i></a>
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
									{{ Form::open(array('url' => URL::to('depositos/' . $deposito->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
										<div class="form-group">
												<label for="input-text" class="col-sm-2 control-label">Deposito</label>
													<div class="col-sm-10">
														{{ Form::text('deposito', $deposito->deposito, array('class' => 'form-control input-lg', 'placeholder'=> 'Ingrese una deposito')) }}
												</div>
											</div>

											<div class="form-group">
													<label for="input-text" class="col-sm-2 control-label">Numero</label>
														<div class="col-sm-10">
															{{ Form::text('numero', $deposito->numero, array('class' => 'form-control input-lg', 'placeholder'=> 'Ingrese numero deposito')) }}
													</div>
												</div>

												<div class="form-group">
														<label for="input-text" class="col-sm-2 control-label">Capacidad</label>
															<div class="col-sm-10">
																{{ Form::text('capacidadkg', $deposito->capacidadkg, array('class' => 'form-control input-lg', 'placeholder'=> 'Ingrese capacidad en Kg.')) }}
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
