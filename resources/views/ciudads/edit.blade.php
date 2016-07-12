@extends('layouts.app')

@section('content')


<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><a href="/ciudads"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/ciudads" class="hidden reload"><i class="icon-ccw-1"></i></a>
									<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
									<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
								</div>
							</div>
							<div class="widget-content">

								<div class="widget-content padding">
									{{ Form::open(array('url' => URL::to('ciudads/' . $ciudad->id), 'method' => 'PUT', 'class' => 'panel-body wrapper-lg')) }}
										<div class="form-group">
										<label for="input-text" class="col-sm-2 control-label">Ciudad</label>
												<div class="col-sm-10">
													{{ Form::text('ciudad', $ciudad->ciudad, array('class' => 'form-control input-lg', 'placeholder'
													 => 'Ingrese una ciudad')) }}
												</div>
												<?php if ($errors->first('ciudad')) { ?>

														<div class="alert alert-danger">
																<button type="button" class="close" data-dismiss="alert">&times;</button>
																<i class="fa fa-ban-circle"></i>
																<strong>Ups... error!</strong>
																<div class="alert-link">{{ $errors->first('ciudad') }}</div>
															</div>

													<?php } ?>
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
