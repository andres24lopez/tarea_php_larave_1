<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Models\Empleado;
use App\Models\Puesto;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $empleados = Empleado::with('puesto')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('codigo', 'like', "%{$search}%")
                        ->orWhere('nombres', 'like', "%{$search}%")
                        ->orWhere('apellidos', 'like', "%{$search}%")
                        ->orWhereHas('puesto', function ($puestoQuery) use ($search) {
                            $puestoQuery->where('puesto', 'like', "%{$search}%");
                        });
                });
            })
            ->orderByDesc('id_empleado')
            ->paginate(5)
            ->withQueryString();

        return view('empleados.index', compact('empleados', 'search'));
    }

    public function create()
    {
        $puestos = Puesto::orderBy('puesto')->get();

        return view('empleados.create', compact('puestos'));
    }

    public function store(StoreEmpleadoRequest $request)
    {
        try {
            Empleado::create($request->validated());

            return redirect()->route('empleados.index')->with('success', 'Empleado registrado correctamente.');
        } catch (\Throwable) {
            return redirect()->route('empleados.index')->with('error', 'No se pudo completar la operación.');
        }
    }

    public function show(Empleado $empleado)
    {
        $empleado->load('puesto');

        return view('empleados.show', compact('empleado'));
    }

    public function edit(Empleado $empleado)
    {
        $empleado->load('puesto');
        $puestos = Puesto::orderBy('puesto')->get();

        return view('empleados.edit', compact('empleado', 'puestos'));
    }

    public function update(UpdateEmpleadoRequest $request, Empleado $empleado)
    {
        try {
            $empleado->update($request->validated());

            return redirect()->route('empleados.index')->with('success', 'Empleado modificado correctamente.');
        } catch (\Throwable) {
            return redirect()->route('empleados.index')->with('error', 'No se pudo completar la operación.');
        }
    }

    public function destroy(Empleado $empleado)
    {
        try {
            $empleado->delete();

            return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
        } catch (\Throwable) {
            return redirect()->route('empleados.index')->with('error', 'No se pudo completar la operación.');
        }
    }
}
