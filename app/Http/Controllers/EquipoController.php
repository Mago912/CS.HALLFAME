<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::withCount('jugadores')->orderBy('nombre')->get();
        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'pais'   => 'nullable|string|max:100',
        ]);

        Equipo::create($request->only('nombre', 'pais'));

        return redirect()->route('equipos.index')
                         ->with('success', '¡Equipo creado correctamente!');
    }

    public function edit($id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, $id)
    {
        $equipo = Equipo::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'pais'   => 'nullable|string|max:100',
        ]);

        $equipo->update($request->only('nombre', 'pais'));

        return redirect()->route('equipos.index')
                         ->with('success', '¡Equipo actualizado correctamente!');
    }

    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();

        return redirect()->route('equipos.index')
                         ->with('success', '¡Equipo eliminado correctamente!');
    }
}
