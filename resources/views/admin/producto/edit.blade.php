@extends('plantilla.admin')


@section('titulo', 'Editar Producto')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{route('admin.producto.index')}}">Productos</a></li>
  <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('estilos')
  <!-- Select2 -->
  <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Select2 -->

  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="/adminlte/plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Ekko Lightbox -->
@endsection
<style type="text/css">

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

</style>
@section('script')
  <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<!-- Select2 -->

<!-- ckeditor -->
<script src="/adminlte/ckeditor/ckeditor.js"></script>
<!-- ckeditor -->

<!-- Ekko Lightbox -->
<script src="/adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Ekko Lightbox -->

<script type="text/javascript">

//PREVISUALIZAR IMAGEN 
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
            "<br/><span class=\"remove\">Eliminar imagen</span>" +
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

//EDITAR
  window.data = {
    //opcion principal form de edicion
    editar:'Si', //objeto
    datos: {
      "nombre":"{{ $producto->nombre}}",
      "stock_disponible":"{{ $producto->stock_disponible}}",
   
    }
  }


  $(function () {
    //Initialize Select2 Elements
    // categoria_id ->categoria
     $('#categoria_id').select2() 

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  });


 // USO DE LIGHTBOX 
  
    //cuando le demos clic a 
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();//si es enclace no se ejecuta
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

</script>
@endsection


@section('contenido')



<div id="apiproducto">
{{-- para multiples imagenes enctype="multipart/form-data"  --}}
<form action="{{ route('admin.producto.update', $producto->id) }}" method="POST" enctype="multipart/form-data" >
@csrf
@method('PUT')
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

                </div>

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Categoria</label>
                  <select name="categoria_id" id="categoria_id" class="form-control" style="width: 100%;">
                    
                    @foreach($categorias as $categoria)

                    {{-- si tengo en la variable categoria es = al nombre --}}
                     @if ($categoria->nombre == $producto->categoria->nombre)
                        <option value="{{ $categoria->id }}" selected="selected">{{ $categoria->nombre }}</option>
                     @else
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                     @endif
                    @endforeach

                  </select>

                  <label>Cantidad</label>
                  <input class="form-control" type="number" id="stock_disponible" name="stock_disponible" value="{{ $producto->stock_disponible}}" >

                  <label>Precio</label>
                  <input class="form-control" type="number" id="precio" name="precio" 
                  value="{{ $producto->precio}}">
                </div>
                <!-- /.form-group -->
    
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
        </div>
      </div>
        <!-- /.card -->
   <div class="row">
          <div class="col-md-12">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Descripciones del producto</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                
                  <textarea class="form-control ckeditor" name="descripcion" id="descripcion" rows="3">
                      {!!$producto->descripcion!!} {{-- con esto escapa el html --}}

                  </textarea>
                
                </div>
                <!-- /.form group -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

       </div>
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
                 <div class="field" align="left">

               </div>
            </div>



          <div class="card card-primary">
          <div class="card-header">
            <div class="card-title">
             Galeria de imagenes
            </div>
          </div>
          <div class="card-body">
            <div class="row">

              @foreach ($producto->images as $image)
             {{--  id="idimagen-{{$image->id}} del api product , methods eliminarimagen --}}
              <div id="idimagen-{{$image->id}}" class="col-sm-2">
                <a href="{{ $image->url }}" data-toggle="lightbox" data-title="Id:{{ $image->id }}"  data-gallery="gallery">
                  <img style="width:150px; height:150px;" src="{{ $image->url }}" class="img-fluid mb-2" />
                </a>
                <br>
                <a href="{{ $image->url }}"
                    v-on:click.prevent="eliminarimagen({{$image}})" {{-- prevent para q no se ejecute esto --}}
                  
                  >
                  <i class="fas fa-trash-alt" style="color:red"></i> Id:{{ $image->id }}
                </a>
              </div>
              
              
              @endforeach
             

              
              
            </div>
               <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                   <a class="btn btn-danger" href="{{ route('cancelar','admin.producto.index') }}">Cancelar</a>
                  <input
                   :disabled = "deshabilitar_boton==1"                 
                  type="submit" value="Guardar" class="btn btn-primary">
                 
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
       </div>
          </div>
        </div>
        </div>
        <!-- /.card -->


     
    </section>
    <!-- /.content -->
    </form>
</div>
 @endsection   