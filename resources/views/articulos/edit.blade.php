@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<div class="row">
					<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><a href="/articulos"><i class="icon-left"></i></a> <strong>{{ $title}}</h2>
								<div class="additional-btn">
									<a href="/articulos" class="hidden reload"><i class="icon-ccw-1"></i></a>
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
									{{ Form::open(array('url' => URL::to('/articulos/' . $articulo->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
										<div class="form-group">
										<label for="input-text" class="col-sm-2 control-label">Articulo</label>
												<div class="col-sm-10">
													{{ Form::text('articulo', $articulo->articulo, array('class' => 'form-control input-lg', 'placeholder'
													 => 'Ingrese un Articulo')) }}
												</div>
											</div>

											<div class="form-group">
												<label for="input-text" class="col-sm-2 control-label">Descripcion</label>
													<div class="col-sm-10">
														{{ Form::text('descripcion', $articulo->descripcion, array('id' => 'descripcion', 'name' => 'descripcion', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese una descripcion')) }}
													</div>
												</div>

												<div class="form-group">
													<label for="input-text" class="col-sm-2 control-label">Categoria</label>
														<div class="col-sm-10">
															{{ Form::text('articuloscategoria', $articuloscategoria->articuloscategoria, array('id' =>'articuloscategoria', 'name' =>'articuloscategoria', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese una categoria')) }}
															{{ Form::hidden('articuloscategorias_id', $articuloscategoria->id, array('id' => 'articuloscategorias_id', 'name' => 'articuloscategorias_id')) }}
														</div>
												</div>


												<div class="form-group">
													<label for="input-text" class="col-sm-2 control-label">Precio Costo</label>
														<div class="col-sm-2">
															{{ Form::text('precio_costo', $articulo->precio_costo, array('id' => 'precio_costo', 'name' => 'precio_costo', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese Precio de Costo')) }}
														</div>
													</div>

													<div class="form-group">
														<label for="input-text" class="col-sm-2 control-label">Porcentaje utilidad</label>
															<div class="col-sm-2">
																{{ Form::text('utilidad', $articulo->utilidad, array('id' => 'utilidad', 'name' => 'utilidad', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese Utilidad')) }}
															</div>
														</div>

														<div class="form-group">
															<label for="input-text" class="col-sm-2 control-label">Porcentaje Iva</label>
																<div class="col-sm-2">
																	{{ Form::text('iva', $articulo->iva, array('id' => 'iva', 'name' => 'iva', 'class' => 'form-control input-lg', 'placeholder' => 'Ingrese Iva')) }}
																</div>
															</div>

															<div class="form-group">
																<label for="input-text" class="col-sm-2 control-label">Precio Publico</label>
																	<div class="col-sm-2">
																		{{ Form::text('precio_publico', $articulo->precio_publico, array('id' => 'precio_publico', 'name' => 'precio_publico', 'class' => 'form-control input-lg', 'placeholder' => 'Precio al Publico')) }}
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


					<script>
					var jq = jQuery.noConflict();
					jq(document).ready( function(){
						$("#articuloscategoria").autocomplete({
							source: "/articuloscategorias/search",
							select: function( event, ui ) {
								$('#articuloscategorias_id').val( ui.item.id );
							}
						});
					});
					</script>



@stop
