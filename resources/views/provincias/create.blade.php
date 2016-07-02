@extends('layouts.app')

@section('content')

<div class="widget">
					<div class="widget-header transparent">
						<h2>{{$title}}</h2>
						<div class="additional-btn">
							<a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
							<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
							<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
						</div>
					</div>
					<div class="widget-content padding">
						{{ Form::open(array('route' => 'provincias.store', 'class' => 'form-horizontal', 'role' => 'form')) }}
						  <div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Provincia</label>
									<div class="col-sm-10">
										{{ Form::text('provincia', '', array('id' => 'provincia', 'name' => 'provincia', 'placeholder' => 'Ingrese una provincia')) }}
									</div>
									<?php if ($errors->first('provincia')) { ?>

											<div class="alert alert-danger">
													<button type="button" class="close" data-dismiss="alert">&times;</button>
													<i class="fa fa-ban-circle"></i>
													<strong>Ups... error!</strong>
													<div class="alert-link">{{ $errors->first('provincia') }}</div>
												</div>

										<?php } ?>
								</div>


						  </div>
							<div class="widget-content padding">
								<div class="form-group">
									{{ Form::submit('Agregar', array('class' => 'btn btn-primary')) }}
								</div>
							</div>

						</form>
					</div>

				</div>
				<!-- End of your awesome content -->
@stop
