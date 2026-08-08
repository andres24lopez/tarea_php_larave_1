@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Detalle del empleado</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary">Volver</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="border rounded p-3 bg-white h-100">
                        <div class="text-muted small">Código</div>
                        <div class="fw-bold fs-5">{{ $empleado->codigo }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="border rounded p-3 bg-white h-100">
                        <div class="text-muted small">Puesto</div>
                        <div class="fw-bold fs-5">{{ $empleado->puesto?->puesto ?? 'Sin puesto' }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="border rounded p-3 bg-white h-100">
                        <div class="text-muted small">Nombres</div>
                        <div class="fw-bold fs-5">{{ $empleado->nombres }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="border rounded p-3 bg-white h-100">
                        <div class="text-muted small">Apellidos</div>
                        <div class="fw-bold fs-5">{{ $empleado->apellidos }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="border rounded p-3 bg-white h-100">
                        <div class="text-muted small">Dirección</div>
                        <div class="fw-bold fs-5">{{ $empleado->direccion ?: '—' }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="border rounded p-3 bg-white h-100">
                        <div class="text-muted small">Teléfono</div>
                        <div class="fw-bold fs-5">{{ $empleado->telefono ?: '—' }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="border rounded p-3 bg-white h-100">
                        <div class="text-muted small">Fecha de nacimiento</div>
                        <div class="fw-bold fs-5">{{ $empleado->fecha_nacimiento }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
