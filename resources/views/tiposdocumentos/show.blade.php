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
							<div class="widget-content">

								<div class="widget-content padding">
									{{ Form::open(array('url' => '/tiposdocumentos/' . $tiposdocumento->id, 'class' => 'panel-body wrapper-lg')) }}
									{{ Form::hidden('_method', 'DELETE') }}


										<div class="form-group">
												<label for="input-text" class="col-sm-2 control-label">Tipo de documento</label>
												<div class="col-sm-10">
													 {{ $tiposdocumento->tiposdocumento }}
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
