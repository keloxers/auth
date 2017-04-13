@extends('layouts.app')

@section('content')


<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-header transparent">
				<h2><a href="/articulos"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
					<div class="additional-btn">
						<a href="/articuloscategorias" class="hidden reload"><i class="icon-ccw-1"></i></a>
						<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
						<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
					</div>
				</div>
				<div class="widget-content">

					<div class="widget-content padding">
						{{ Form::open(array('url' => '/articulos/' . $articulo->id, 'class' => 'form-horizontal')) }}
						{{ Form::hidden('_method', 'DELETE') }}


						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Articulo</label>
							<div class="col-sm-10">
								{{ $articulo->articulo }}
							</div>
						</div>


						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Codigo Barra</label>
							<div class="col-sm-10">
								{{ $articulo->codigobarra }}
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Descripcion</label>
							<div class="col-sm-10">
								{{ $articulo->descripcion }}
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Categoria</label>
							<div class="col-sm-10">
								{{ $articulo->articuloscategorias->articuloscategoria }}
							</div>
						</div>


						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Precio Costo</label>
							<div class="col-sm-2">
								{{ $articulo->precio_costo }}
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Porcentaje utilidad</label>
							<div class="col-sm-2">
								{{ $articulo->utilidad }}
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Porcentaje Iva</label>
							<div class="col-sm-2">
								{{ $articulo->iva }}
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Precio Publico</label>
							<div class="col-sm-2">
								{{ $articulo->precio_publico }}
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
