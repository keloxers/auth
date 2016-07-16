@extends('layouts.app')

@section('content')


<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><a href="/tiposdocumentos"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/tiposdocumentos" class="hidden reload"><i class="icon-ccw-1"></i></a>
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
									{{ Form::open(array('url' => URL::to('tiposdocumentos/' . $tiposdocumento->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
										<div class="form-group">
										<label for="input-text" class="col-sm-2 control-label">Tipo de documento</label>
												<div class="col-sm-10">
													{{ Form::text('tiposdocumento', $tiposdocumento->tiposdocumento, array('class' => 'form-control input-lg', 'placeholder'
													 => 'Ingrese una tiposdocumento')) }}
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
