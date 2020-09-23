@extends('plantilla.admin')

@section('titulo', 'Crear Categoría')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.categoria.index')}}">Categorías</a></li>

<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')


<div id="apicategoria">
<form action="{{ route('admin.categoria.store')}}" method="post">
  @csrf
<div class="card">
        <div class="card-header">
          <h3 class="card-title">Administración de Categorias</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
    
      
        <h1>Crear Categoría</h1>
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <!-- v-model="nombre" queremos q el campo de nombre se enlace con la variable que esta detro de data el cuas es nombre-->

          <!--si blur es = al getCategory .... @focus="div_aparecer" ->ejecuta la funcion del axios-->
          <input v-model="nombre" 
          @blur="getCategory" 
          @focus= "div_aparecer= false"
          class="form-control" type="text" name="nombre" id="nombre">
          
          <!--readonly="" para q nadie modifique-->
          <label for="slug">Slug</label>
          <input readonly="" v-model="generarSlug" class="form-control" type="text" name="slug" id="slug">
          
          <!--v-bind:class->clase dinamica q sera el nombre de una variable div_clase_slug-->
          <div v-if='div_aparecer' v-bind:class="div_clase_slug">
            @{{div_mensajeslug}}
          </div>
          
          <br v-if='div_aparecer'>

         

        </div>
        <!--Cuando esta variable tega el 1 se va desabilitar-->
        
      {{-- @{{nombre}}

      <br>

      @{{generarSlug}}
      <br>
diferenciar mensaje entre vuejs y laravel
@ -> vue
      @{{slug}} --}}
    
  </div>
       
        <!-- /.card-body -->
        <div class="card-footer">
          <a class="btn btn-danger" href="{{ route('cancelar','admin.categoria.index')}}">Cancelar</a>
           <input 
                  
                  type="submit" value="Guardar" class="btn btn-primary float-right">

        
        </div>
        <!-- /.card-footer-->
</div>
</div>
</form>
@endsection
{{-- diferenciar mensaje entre vuejs y laravel
@ -> vue --}}