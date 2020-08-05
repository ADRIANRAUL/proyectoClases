@extends('layouts.admin')

@section('content')
<div class="modal fade" id="postModal" tabindex="-1" post="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalLabel">Nueva Pubicaciòn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="postForm">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="name">Titulo</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="content">Contenido</label>
                        <input type="text" class="form-control" id="content" name="content">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button id="closeForm" type="button" class="btn btn-secondary">Cancelar</button>
                    <div id="errors" class="alert-danger mt-2"></div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Listado de Publicaciones</div>

                <div class="card-body">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#postModal">
                                    Agregar una publicaciòn
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col p-4">
                                <table id="postTable" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Contenido</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#postTable').DataTable({
            "ajax": '{{ route('posts.index') }}',
            columns: [
                {"data": "id" },
                {"data": "name"},
                {"data": "content"},
                {
                    "mData": "id",
                    "mRender": function(data,type,row){
                        return "<button class='edit-post' data-user='"+ JSON.stringify(row) +"'>editar</button>" +
                            "<button class='delete-post' data-id='"+ row.id +"' >eliminar</button>"
                    }
                }
            ]
        })
        $('#postForm').submit(function(e){
            e.preventDefault();
            let form = $(this).serializeArray()
            let url = "{{ url('api/v1/posts')  }}"
            //adecuación para editar
            let id = document.getElementById("id");
            if (id && id.value) {
                form.push({"name":"_method", "value":'PUT'});
                url = url+"/"+id.value
            }
            //fin adecuación para editar
            $.ajax({
                type : "post",
                url : url,
                data: form,
                success: function(data){
                    alert(data.status);
                    clearForm();
                    closeModal();
                    reloadData()
                },
                error: function(data){
                    let error = $.parseJSON(data.responseText);
                    showErrors(error.errors);
                }
            })
        })
        $(document).on('click','button.delete-post',function(){
            let id =  $(this).data('id');
            if (confirm('¿Desea realmente eliminar el registro? '+id)) {
                
                $.ajax({
                    type: "POST",
                    url: "{{ url('api/v1/posts')  }}"+"/"+id,
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data)
                    {
                        alert(data.status);
                        reloadData();
                    },
                    error: function(error){
                        alert('ha ocurrido un error')
                    }
                });
            }
        })
        //se ejecuta cuando se da click en el botón editar
        $(document).on('click','button.edit-post',function(){
            let idPost =  $(this).data('id');
            console.log(idPost);

/*             fillForm($(this).data('Post'));
            
            openModal(); */
        });
        //se ejecuta cuando se da click en el botón eliminar
        $(document).on('click','button#closeForm',function(){
            clearForm();
            closeModal();
        });
        //función que recarga los datos del datatable
        function reloadData(){
            $("#postTable").DataTable().ajax.reload();
        }
        //funcion que permite visualizar errores
        function showErrors(errors){
            let message = '<span class="p-2">';
            $.each(errors, function (key,value) { message += value + "\n"; });
            message += '</span>';
            $('#errors').html(message);
        }
        function fillForm(data){
            document.getElementById('id').value = data.id;
            document.getElementById('name').value = data.name;
            document.getElementById('content').value = data.content;

        }
        function clearForm(){
            document.getElementById('id').value = '';
            $('#postForm')[0].reset();
            $('#errors').html('');
        }
        //funciones de ayuda para el formulario modal
        function closeModal(){ $("#postModal").modal('hide'); }
        function openModal(){ $("#postModal").modal('show'); }
        $(function(){
            $('#postModal').on('hide.bs.modal', function (event) {
                clearForm();
            })
        });
    </script>
@endsection