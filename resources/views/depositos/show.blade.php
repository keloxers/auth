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
							<div class="widget-content">

								<div class="widget-content padding">
									{{ Form::open(array('url' => '/depositos/' . $deposito->id, 'class' => 'panel-body wrapper-lg')) }}
									{{ Form::hidden('_method', 'DELETE') }}


										<div class="form-group">
												<label for="input-text" class="col-sm-2 control-label">Deposito</label>
												<div class="col-sm-10">
													 {{ $deposito->deposito }}
												</div>
											</div>

											<div class="form-group">
													<label for="input-text" class="col-sm-2 control-label">Numero</label>
													<div class="col-sm-10">
														 {{ $deposito->numero }}
													</div>
												</div>

												<div class="form-group">
														<label for="input-text" class="col-sm-2 control-label">Capcidad en Kg.</label>
														<div class="col-sm-10">
															 {{ $deposito->capacidadkg }}
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
