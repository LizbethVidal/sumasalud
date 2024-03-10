@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <h1 class="text-center">Crear Paciente</h1>
            <hr>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('pacientes.store')}}" enctype="multipart/form-data">
                        {{-- <input type="hidden" name="rol" value="paciente"> --}}
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @if($errors->has('name')) is-invalid @endif"
                                    placeholder="Nombre" required value="{{old('name')}}">
                                @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="email">Correo</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @if($errors->has('email')) is-invalid @endif"
                                    placeholder="Correo" required value="{{old('email')}}">
                                @if($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label for="dni">DNI</label>
                                <input type="text" name="dni" id="dni"
                                    class="form-control @if($errors->has('dni')) is-invalid @endif" placeholder="DNI"
                                    required value="{{old('dni') ?? request()->get('dni')}}">
                                @if($errors->has('dni'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('dni')}}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label for="movil">Teléfono</label>
                                <input type="text" name="movil" id="movil"
                                    class="form-control @if($errors->has('movil')) is-invalid @endif"
                                    placeholder="Teléfono" required value="{{old('movil')}}">
                                @if($errors->has('movil'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('movil')}}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_nac">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nac" id="fecha_nac"
                                    class="form-control @if($errors->has('fecha_nac')) is-invalid @endif"
                                    placeholder="Fecha de Nacimiento" value="{{old('fecha_nac')}}">
                                @if($errors->has('fecha_nac'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('fecha_nac')}}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label for="tutor">Tutor</label>
                                <input readonly="true" type="text" name="tutor" id="tutor" class="form-control" placeholder="Tutor">
                                <input type="hidden" name="tutor_id" id="tutor_id">
                            </div>
                            <div class="col-md-12">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" id="direccion"
                                    class="form-control @if($errors->has('direccion')) is-invalid @endif"
                                    placeholder="Dirección" value="{{old('direccion')}}">
                                @if($errors->has('direccion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('direccion')}}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" id="foto"
                                    class="form-control @if($errors->has('foto')) is-invalid @endif" placeholder="Foto"
                                    value="{{old('foto')}}">
                                @if($errors->has('foto'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('foto')}}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label for="medico">Médico de cabecera</label>
                                <select name="medico_id" id="medico_id"
                                    class="form-control @if($errors->has('medico_id')) is-invalid @endif">
                                    <option value="">Seleccione un médico</option>
                                    @foreach($medicos as $medico)
                                    <option value="{{$medico->id}}">{{$medico->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('medico_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('medico_id')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @if($errors->has('password')) is-invalid @endif"
                                    placeholder="Contraseña" required>
                                @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('password')}}</strong>
                                </span>
                                @endif

                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control @if($errors->has('password_confirmation')) is-invalid @endif"
                                    placeholder="Confirmar Contraseña" required>
                                @if($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('password_confirmation')}}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-12 d-none" id="alergias_list">
                                <div class="col-12 mt-3">
                                    <h3>Alergias</h3>
                                    <div class="row" id="alergias">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <button type="button" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#modal_tutor">
                                    <i class="bi bi-person-plus"></i> Asignar Tutor
                                </button>
                                <button type="button" class="btn btn-success" onclick="add_alergia()">
                                    <i class="bi bi-plus"></i> Añadir alergias
                                </button>
                                <button class="btn btn-primary" type="submit">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-2">
                <a href="{{route('pacientes.index')}}" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_tutor" tabindex="-1" aria-labelledby="modal_tutor" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Tutor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="user_id" value="">
                <div class="row">
                    <div class="col-12">
                        <label for="tutor_search">DNI</label>
                        <input type="text" name="tutor_search" id="tutor_search" class="form-control" placeholder="Buscar Tutor">
                    </div>
                </div>
                <div class="row" id="tutors">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close_modal" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="search_tutor()">Buscar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function search_tutor() {
        var tutor_search = $('#tutor_search').val();
        $.ajax({
            url: '/users/search_tutor',
            type: 'POST',
            data: {
                _token: $('input[name=_token]').val(),
                tutor_search: tutor_search,
                user_id: $('#user_id').val()
            },
            success: function (response) {
                var tutors = response.tutors;
                var html = '';
                tutors.forEach(tutor => {
                    html += '<div class="col-12 mt-3">';
                    html += '<button type="button" class="btn btn-outline-dark" onclick="assign_tutor('+tutor.id+', \''+tutor.name+'\')">';
                    html += tutor.name;
                    html += '</button>';
                    html += '</div>';
                });

                if(tutors.length == 0) {
                    html += '<div class="col-12 mt-3">';
                    html += '<p>No se encontraron resultados, recuerde que debe buscar por DNI</p>';
                    html += '</div>';
                }
                $('#tutors').html(html);
            }
        });
    }

    function assign_tutor(tutor_id, tutor_name) {
        $('#tutor').val(tutor_name);
        $('#tutor_id').val(tutor_id);
        $('#close_modal').click();
    }

    function add_alergia() {
        let count = $('#alergias').children().length;

        if(count == 0) {
            $('#alergias_list').removeClass('d-none');
        }

        var html = '';
        html += `<div class="col-3 mt-2" id="alergia_${count}">
                    <div class="input-group">
                        <input type="text" class="form-control" name="alergias[]" placeholder="Alergia">
                        <button class="btn btn-outline-danger" type="button" onclick="remove_alergia(${count})">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>`;
        $('#alergias').append(html);
    }

    function remove_alergia(count) {
        $(`#alergia_${count}`).remove();

        let children = $('#alergias').children().length;

        if(children == 0) {
            $('#alergias_list').addClass('d-none');
        }
    }

</script>

<script type="module">
    $(document).ready(function() {
        $('#modal_tutor').on('hidden.bs.modal', function (e) {
            $('#tutor_search').val('');
            $('#tutors').html('');
        });

        $('#medico_id').select2({
            placeholder: 'Seleccione un médico',
            theme: 'bootstrap-5'
        });
    });
</script>
@endsection
