@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-white py-3">
            <h2 class="h5 mb-0">Modificar empleado</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('empleados.update', $empleado) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-6">
                    <label class="form-label required" for="codigo">Código</label>
                    <input id="codigo" name="codigo" type="text" value="{{ old('codigo', $empleado->codigo) }}" class="form-control @error('codigo') is-invalid @enderror" maxlength="10" required>
                    @error('codigo')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label required" for="id_puesto">Puesto</label>
                    <select id="id_puesto" name="id_puesto" class="form-select @error('id_puesto') is-invalid @enderror" required>
                        <option value="">Seleccione un puesto</option>
                        @foreach ($puestos as $puesto)
                            <option value="{{ $puesto->id_puesto }}" {{ old('id_puesto', $empleado->id_puesto) == $puesto->id_puesto ? 'selected' : '' }}>
                                {{ $puesto->puesto }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_puesto')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label required" for="nombres">Nombres</label>
                    <input id="nombres" name="nombres" type="text" value="{{ old('nombres', $empleado->nombres) }}" class="form-control @error('nombres') is-invalid @enderror" required>
                    @error('nombres')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label required" for="apellidos">Apellidos</label>
                    <input id="apellidos" name="apellidos" type="text" value="{{ old('apellidos', $empleado->apellidos) }}" class="form-control @error('apellidos') is-invalid @enderror" required>
                    @error('apellidos')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="direccion">Dirección</label>
                    <input id="direccion" name="direccion" type="text" value="{{ old('direccion', $empleado->direccion) }}" class="form-control @error('direccion') is-invalid @enderror">
                    @error('direccion')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="telefono">Teléfono</label>
                    <input id="telefono" name="telefono" type="text" value="{{ old('telefono', $empleado->telefono) }}" class="form-control @error('telefono') is-invalid @enderror" maxlength="8" placeholder="Ej: 98765432">
                    @error('telefono')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label required" for="fecha_nacimiento">Fecha de nacimiento</label>
                    <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="{{ old('fecha_nacimiento', $empleado->fecha_nacimiento) }}" class="form-control @error('fecha_nacimiento') is-invalid @enderror" required>
                    @error('fecha_nacimiento')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 d-flex justify-content-between">
                    <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary">Volver</a>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
@endsection
