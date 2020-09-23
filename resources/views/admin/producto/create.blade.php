@extends('plantilla.admin')


@section('titulo', 'Crear Producto')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{route('admin.producto.index')}}">Productos</a></li>
  <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('estilos')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Select2 -->
@endsection
<style type="text/css">
/*PREVIZUALIZAR IMAGEN SIN ELIMINAR*/
/*input[type="imagenes"] {
 
 display:block;
}
.imageThumb {
 max-height: 150px;
 border: 2px solid;
 margin: 10px 10px 0 0;
 padding: 1px;
 }*/
 /*PREVIZUALIZAR IMAGEN SIN ELIMINAR*/

 /*PREVIZUALIZAR IMAGEN eliminandolaR*/
 input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 150px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
 /*PREVIZUALIZAR IMAGEN eliminandolaR*/

</style>

@section('script')
  <script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Select2 -->
<!-- ckeditor -->
<script src="{{asset('adminlte/ckeditor/ckeditor.js')}}"></script>
<!-- ckeditor -->


<script type="text/javascript">

 


  //PREVISUALIZAR IMAGEN SIN ELIMINAR
//  $(document).ready(function() {
 
//  if(window.File && window.FileList && window.FileReader) {
//  $("#imagenes").on("change",function(e) {
//  var imagenes = e.target.files ,
//  filesLength = imagenes.length ;
//  for (var i = 0; i < filesLength ; i++) {
//  var f = imagenes[i]
//  var fileReader = new FileReader();
//  fileReader.onload = (function(e) {
//  var imagenes = e.target;
//  $("<img></img>",{
//  class : "imageThumb",
//  src : e.target.result,
//  title : imagenes.name
//  }).insertAfter("#imagenes");
//  });
//  fileReader.readAsDataURL(f);
//  }
// });
//  } else { alert("Your browser doesn't support to File API") }
// });
//PREVISUALIZAR IMAGEN SIN ELIMINAR

//PREVISUALIZAR IMAGEN ELIMINANDOLA

 $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#imagenes").on("change", function(e) {
      var imagenes = e.target.files,
        filesLength = imagenes.length;
      for (var i = 0; i < filesLength; i++) {
        var f = imagenes[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">x</span>" +
            "</span>").insertAfter("#imagenes");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
//PREVISUALIZAR IMAGEN ELIMINANDOLA
    
  $(function () {
    //Initialize Select2 Elements
    // categoria_id ->categoria
     $('#categoria_id').select2() 

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  });
</script>
@endsection


@section('contenido')



<div id="apiproducto">
{{-- para multiples imagenes enctype="multipart/form-data"  --}}
<form action="{{ route('admin.producto.store') }}" method="POST" enctype="multipart/form-data" >
@csrf
  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
    
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Datos del producto</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">

                  <label>Nombre</label>
                  <input v-model="nombre" 
                    @blur="getProduct" 
                    @focus= "div_aparecer= false"
                    class="form-control" type="text" name="nombre" id="nombre">

                  <label>Slug</label>
                  <input 
                  readonly v-model="generarSlug"
                  class="form-control" type="text" id="slug" name="slug" >
                  
                  <div v-if='div_aparecer' v-bind:class="div_clase_slug">
                    @{{div_mensajeslug}}
                  </div>
          
                  <br v-if='div_aparecer'>

                  <label>Precio</label>
                  <input class="form-control" type="number" id="precio" name="precio" value="0" >
                  
                </div>

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Categoria</label>
                  <select name="categoria_id" id="categoria_id" class="form-control" style="width: 100%;">
                    
                    @foreach($categorias as $categoria)

                    {{-- si recorrio el primer registro aparesca la categoria1 --}}
                     @if ($loop->first)
                        <option value="{{ $categoria->id }}" selected="selected">{{ $categoria->nombre }}</option>
                     @else
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                     @endif
                    @endforeach

                  </select>
                  

                  <label>Cantidad</label>
                  <input class="form-control" type="number" id="stock_disponible" name="stock_disponible" value="0" >

                  <label>Descripción</label>
                  <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                </div>
                <!-- /.form-group -->
    
                
                
             
              </div>

              
                <!-- /.form group -->

         
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
        
      </div>

        <!-- /.col-md-6 -->
      
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
         <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Imagenes</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="form-group">
                
               <label for="imagenes">Añadir imágenes</label> 
                              
               <input type="file" class="form-control-file" name="imagenes[]" id="imagenes" multiple />
         
               <div class="description">
                Un número ilimitad de archivos que pueden ser cargados en este campo
                 <br>
                 Límite 2048 MB por imagen.
                 <br>
                 Tipos permitidos: jpeg, png, jpg, gif, svg, webp.
                 <br>
               </div>
            </div>


      <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                   <a class="btn btn-danger" href="{{ route('cancelar','admin.producto.index') }}">Cancelar</a>
                   <input
                             
                  type="submit" value="Guardar" class="btn btn-primary">
                 
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
       </div>
          </div>

        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </form>
</div>
 @endsection   