@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <h1 class="text-center">Búsqueda de paciente</h1>
                <hr>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="dni_paciente">Paciente</label>
                                <input type="text" name="dni_paciente" id="dni_paciente" class="form-control">
                                <input type="hidden" name="paciente_id" id="paciente_id" class="form-control">
                            </div>
                            <div class="col-md-6 d-none" id="box-paciente">
                                <label for="nombre_paciente">Nombre</label>
                                <input type="text" name="nombre_paciente" id="nombre_paciente" class="form-control" readonly>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-primary mt-3" id="crearCita">Seleccionar paciente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script type="module">
        $(document).ready(function(){
            $('#dni_paciente').on('input', function(){
                let dni = $(this).val();
                if(dni.length == 9){
                    $.ajax({
                        url: `{{route('citas.paciente')}}?dni=${dni}`,
                        type: 'GET',
                        success: function(response){
                            if(response.status == 'success'){
                                //Quitar clases de error
                                $('#dni_paciente').removeClass('is-invalid');
                                // Agregar clases de éxito
                                $('#dni_paciente').addClass('is-valid');
                                // Agregar el nombre del paciente
                                $('#nombre_paciente').val(response.data.name);
                                // Guardar el id del paciente
                                $('#paciente_id').val(response.data.id);
                                // Mostrar el campo de nombre
                                $('#box-paciente').removeClass('d-none');
                            }else{
                                //Quitar clases de éxito
                                $('#dni_paciente').removeClass('is-valid');
                                // Agregar clases de error
                                $('#dni_paciente').addClass('is-invalid');
                                // Limpiar el campo de nombre
                                $('#nombre_paciente').val('');
                                // Limpiar el id del paciente
                                $('#paciente_id').val('');
                                // Ocultar el campo de nombre
                                $('#box-paciente').addClass('d-none');

                                // Mostrar mensaje de error
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar',
                                    footer: `<a class="btn btn-secondary" href="{{route('pacientes.create')}}?dni=${$('#dni_paciente').val()}">Dar de alta</a>`
                                })
                            }
                        },
                        error: function(error){
                            console.log(error);
                        }
                    });
                }else{
                    $('#dni_paciente').removeClass('is-valid');
                    $('#dni_paciente').removeClass('is-invalid');
                    $('#nombre_paciente').text('');
                }
            });

            $('#crearCita').on('click', function(){
                let paciente_id = $('#paciente_id').val();
                if(paciente_id){
                    window.location.href = `{{route('citas.create')}}?paciente_id=${paciente_id}`;
                }
            });
        });
    </script>
@endsection
