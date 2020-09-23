@extends('plantilla.admin')

@section('titulo', 'Administración de Productos')

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
{{-- {{dd($productos)}} --}}

{{-- {{ $productos[0]->category}}  --}}{{-- uestrame el primer producto q tienes en la variable productos de la tabla productos --}}
<style type="text/css">
  .table1 {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    text-align: center;
  } 

  .table1 td, table1 th {
    padding: .75rem; /*ariibaabajoylados*/
    text-align: center;
    border-top: 1px solid #dee2e6;
  }
</style>

<div id="confirmareliminar" class="row">

  <span style="display:none;" id="urlbase">{{route('admin.producto.index')}}</span>
    @include('custom.modal_eliminar')

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sección de productos</h3>

                <div class="card-tools">
                
                  <form>
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="nombre" class="form-control float-right" placeholder="Buscar"
                      value="{{ request()->get('nombre')}}">
{{--  value="{{ request()->get('nombre')}} para que no se pierda lo q coloco en el buscador --}}
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </form>


                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" >
                <a class="m-2 float-right btn btn-primary" href="{{ route('admin.producto.create') }}">Crear</a>
                <table class="table1 table-head-fixed">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Imagen</th>
                      <th>Nombre</th>
                      {{-- <th>Descripción</th> --}}
                      <th colspan="3">Acciones</th>{{-- tomaremos 3 espacios --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($productos as $producto)
                      <tr>
                     
                      <td> {{ $producto->id}}</td>
                       {{--  mostrar una imagen --}}
                       {{-- si la cantidad de imagenes es <= a 0 no hay imagen --}}
                        <td>
                          @if ($producto->images->count()<=0)
                            <img style="height: 100px; width:100px;" src="/imagenes/avatar.png" class="rounded-circle">
                          @else
                            <img style="height: 100px; width:100px;" src="{{ $producto->images->random()->url}}" class="rounded-circle">
                          @endif

                        </td>
                     
                     
                        <td> {{ $producto->nombre}}</td>
                       {{--  <td> {{ $producto->descripcion}}</td> --}}
                        <td>
                          <a class="btn btn-default" href="{{ route('admin.producto.show', $producto->slug) }}"><i class="fa fa-eye"></i></a>
                        </td>

                        <td>
                          <a class="btn btn-info" href="{{ route('admin.producto.edit', $producto->slug) }}"><i class="fa fa-edit"></i></a>
                        </td>

                        <td>
                          <a class="btn btn-danger" 
                          href="{{ route('admin.producto.index') }}"
                          v-on:click.prevent="deseas_eliminar({{$producto->id}})" ><i class="fa fa-trash"></i></a>
                        </td>

                      </tr>
                    @endforeach
                    
                  </tbody>
                </table>
                {{-- {{ $productos->links()}} paginador --}}
                {{ $productos->appends($_GET)->links()}} {{-- al buscar un nombre que se mantenga lo q se busca en la url --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
</div>
@endsection
