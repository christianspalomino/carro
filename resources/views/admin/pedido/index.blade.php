@extends('plantilla.admin')

@section('titulo', 'Administración de Pedidos')

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')

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

  <span style="display:none;" id="urlbase">{{route('admin.pedido.index')}}</span>
    @include('custom.modal_eliminar')

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sección de Pedidos</h3>

                <div class="card-tools">
                
                  <form>
                   {{--  <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="nombre" class="form-control float-right" placeholder="Buscar"
                      value="{{ request()->get('nombre')}}">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div> --}}
                  </form>


                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" >
                <table class="table1 table-head-fixed">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Apellidos</th>
                      <th>E-mail</th>
                      <th>Carro</th>
                      <th colspan="3">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($pedidos as $pedido)
                      <tr>
                     
                      <td> {{ $pedido->id}}</td>
                     
                        <td> {{ $pedido->nombres}}</td>
                        <td> {{ $pedido->apellidos}}</td>
                        <td> {{ $pedido->email}}</td>
                        <td> {{ $pedido->carro}}</td>
                     
                    
                       {{--  @foreach($pedido->carro as $detallecarrito)
                            {{$detallecarrito->id}}

                        @endforeach --}}

                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- {{ $pedidos->links()}} paginador --}}
                 {{-- al buscar un nombre que se mantenga lo q se busca en la url --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
</div>
@endsection
