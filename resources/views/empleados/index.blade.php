@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-white py-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                <h2 class="h5 mb-0">Listado de empleados</h2>

                <form method="GET" action="{{ route('empleados.index') }}" class="d-flex gap-2 align-items-center search-form">
                    <input type="search" name="search" value="{{ old('search', $search) }}" class="form-control" placeholder="Buscar empleado..." aria-label="Buscar empleado">
                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                    @if ($search !== '')
                        <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                    @endif
                </form>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Código</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Nacimiento</th>
                            <th>Puesto</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->codigo }}</td>
                                <td>{{ $empleado->nombres }}</td>
                                <td>{{ $empleado->apellidos }}</td>
                                <td>{{ $empleado->direccion ?: '—' }}</td>
                                <td>{{ $empleado->telefono ?: '—' }}</td>
                                <td>{{ $empleado->fecha_nacimiento }}</td>
                                <td>{{ $empleado->puesto?->puesto ?? 'Sin puesto' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('empleados.show', $empleado) }}" class="btn btn-sm btn-info text-white">Detalle</a>
                                        <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" data-confirm="¿Desea eliminar este empleado?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-secondary py-4">
                                    @if ($search !== '')
                                        No existen empleados con el término de búsqueda "{{ $search }}".
                                    @else
                                        No hay empleados registrados.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($empleados->count() > 0)
            <div class="card-footer bg-white text-secondary small">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                    <div>Mostrando {{ $empleados->count() }} de {{ $empleados->total() }} registros.</div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        {{ $empleados->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
