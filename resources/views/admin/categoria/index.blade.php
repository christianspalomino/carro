@extends('plantilla.admin')

@section('titulo', 'Administración de Categorías')

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
{{-- {{dd($categorias)}} --}}
<div id="confirmareliminar" class="row">

  <span style="display:none;" id="urlbase">{{route('admin.categoria.index')}}</span>
    @include('custom.modal_eliminar')

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sección de categorías</h3>

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
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <a class="m-2 float-right btn btn-primary" href="{{ route('admin.categoria.create') }}">Crear</a>
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                  {{--     <th>Slug</th> --}}
                     {{--  <th>Descripción</th> --}}
                     {{--  <th>Fecha creación</th>
                      <th>Fecha modificación</th> --}}
                      <th colspan="3">Acciones</th>{{-- tomaremos 3 espacios --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categorias as $categoria)
                      <tr>

                        <td> {{ $categoria->id}}</td>
                        <td> {{ $categoria->nombre}}</td>
                       {{--  <td> {{ $categoria->slug}}</td> --}}
                     {{--    <td> {{ $categoria->descripcion}}</td> --}}
                        {{-- <td> {{ $categoria->created_at}}</td>
                        <td> {{ $categoria->updated_at}}</td> --}}

                        <td>
                          <a class="btn btn-default" href="{{ route('admin.categoria.show', $categoria->slug) }}"><i class="fa fa-eye"></i></a>
                      
                          <a class="btn btn-info" href="{{ route('admin.categoria.edit', $categoria->slug) }}"><i class="fa fa-edit"></i></a>
                       
                          <a class="btn btn-danger" 
                          href="{{ route('admin.categoria.index') }}"
                          v-on:click.prevent="deseas_eliminar({{$categoria->id}})" ><i class="fa fa-trash"></i></a>
                        </td>

                      </tr>
                    @endforeach
                    
                  </tbody>
                </table>
                {{-- {{ $categorias->links()}} paginador --}}
                {{ $categorias->appends($_GET)->links()}} {{-- al buscar un nombre que se mantenga lo q se busca en la url --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
</div>
@endsection
