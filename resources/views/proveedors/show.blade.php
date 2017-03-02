@extends('layouts.app')

@section('content')


<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-header transparent">
				<h2><a href="/proveedors"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
					<div class="additional-btn">
						<a href="/proveedors" class="hidden reload"><i class="icon-ccw-1"></i></a>
						<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
						<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
					</div>
				</div>
				<div class="widget-content">

					<div class="widget-content padding">
						{{ Form::open(array('url' => '/proveedors/' . $proveedor->id, 'class' => 'form-horizontal')) }}
						{{ Form::hidden('_method', 'DELETE') }}


							<div class="form-group">
								<label for="input-text" class="col-sm-2 control-label">Proveedor</label>
								<div class="col-sm-7">
									{{ $proveedor->proveedor }}
								</div>
							</div>

							<div class="form-group">
								<label for="input-text" class="col-sm-2 control-label">Domicilio Fiscal</label>
								<div class="col-sm-10">
									{{ $proveedor->domicilio_fiscal }}
								</div>
							</div>

							<div class="form-group">
								<label for="input-text" class="col-sm-2 control-label">Cuit</label>
								<div class="col-sm-3">
									{{ $proveedor->cuit }}
								</div>
							</div>

							<div class="form-group">
								<label for="input-text" class="col-sm-2 control-label">Tipo Iva</label>
								<div class="col-sm-5">

									{{ $proveedor->tipoivas->tipoiva }}
								</div>
							</div>

							<div class="form-group">
								<label for="input-text" class="col-sm-2 control-label">Telefono</label>
								<div class="col-sm-4">
									{{ $proveedor->telefono }}
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
