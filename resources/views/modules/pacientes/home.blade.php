@extends('layouts.app')

@section('content')
{{-- Vista home para el paciente --}}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between gap-3 align-items-center flex-md-row flex-column">
                    <div>
                        <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : '/images/default.png' }}" alt="Foto de perfil" class="img-thumbnail" width="100px">
                    </div>
                    <div >
                        <h3 class="card-title">Bienvenido {{ Auth::user()->name }}</h3>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 d-flex justify-content-start mb-md-0 mb-3 gap-1 flex-md-column flex-row">
                            <div class="text-center">
                                <a href="{{ route('pacientes.show', Auth::user()->id) }}" class="btn btn-primary">Ver mi perfil</a>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('pacientes.solicitar_cita') }}" class="btn btn-success">Agendar cita</a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-md-0 mb-3">
                            @if(Auth::user()->personas_cargo()->count() > 0)
                                <div class="card">
                                    <h5 class="card-header">
                                        Personas a cargo
                                    </h5>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            @foreach(Auth::user()->personas_cargo as $persona)
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <img src="{{ $persona->foto ? asset('storage/' . $persona->foto) : '/images/default.png' }}" alt="Foto de perfil" class="img-thumbnail" width="100px">
                                                                <p>{{ $persona->name }}</p>
                                                                <a href="{{ route('pacientes.show', $persona->id) }}" class="btn btn-primary">Ver perfil</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if(Auth::user()->proxima_cita())
                                <div class="card">
                                    <h5 class="card-header">
                                        Próxima cita
                                    </h5>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div>
                                                <p>{{ Auth::user()->proxima_cita()->fecha_hora }} - {{ Auth::user()->proxima_cita()->doctor->name }}</p>
                                            </div>
                                            <div>
                                                <a href="{{ route('citas.show', Auth::user()->proxima_cita()->id) }}" class="btn btn-primary">Ver cita</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between gap-3 align-items-center flex-md-row flex-column">
                    <div>
                        <h3 class="card-title">Historial médico</h3>
                    </div>
                    <div>
                        <button class="btn btn-primary" id="btnHistorial">Ver historial</button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="historial_resultados">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between gap-3 align-items-center flex-md-row flex-column">
                    <div>
                        <h3 class="card-title">Historial de citas</h3>
                    </div>
                    <div>
                        <button class="btn btn-primary" id="btnCitas">Ver todas mis citas</button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="citas_resultados">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-start mt-3">
            {{-- promo card img --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Promoción dental</h5>
                </div>
                <img src="/images/promo.png" alt="Promoción" class="card-img-top" style="max-height: 300px; max-width: 50rem;">
            </div>
        </div>
        {{-- mapa donde estamos --}}
        <div class="col-12 col-md-6 d-flex justify-content-center mt-3">
            <div class="card" style="">
                <div class="card-header">
                    <h5 class="card-title">Donde estamos</h5>
                </div>
                <div class="card-body">
                    @if(!$agent->isMobile())
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2487.8633677478338!2d-15.434504579602292!3d28.135218921985683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xc409515abc24011%3A0x96f3c1962fadbe90!2sC.%20Tom%C3%A1s%20Miller%2C%201%2C%2035007%20Las%20Palmas%20de%20Gran%20Canaria%2C%20Las%20Palmas!5e0!3m2!1ses!2ses!4v1710679809480!5m2!1ses!2ses" width="600" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @else
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2487.8633677478338!2d-15.434504579602292!3d28.135218921985683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xc409515abc24011%3A0x96f3c1962fadbe90!2sC.%20Tom%C3%A1s%20Miller%2C%201%2C%2035007%20Las%20Palmas%20de%20Gran%20Canaria%2C%20Las%20Palmas!5e0!3m2!1ses!2ses!4v1710679809480!5m2!1ses!2ses" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module">
    $(document).ready(function(){
        $('#btnHistorial').click(function(){
            $.ajax({
                url: "{{ route('pacientes.historial', ['paciente' => Auth::user()]) }}",
                type: 'GET',
                success: function(response){
                    $('#historial_resultados').html(response);
                }
            });
        });

        $('#btnCitas').click(function(){
            $.ajax({
                url: "{{ route('pacientes.citas', ['paciente' => Auth::user()]) }}",
                type: 'GET',
                success: function(response){
                    $('#citas_resultados').html(response);
                }
            });
        });
    });

</script>
@endsection
