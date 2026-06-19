<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jugadores = Jugador::with('equipo')->get();

        return view('jugadores.index', compact('jugadores'));
    }


public function home()
{
    $totalJugadores = Jugador::count();

    $masMvps = Jugador::orderBy('mvps', 'desc')->first();

    $masMajors = Jugador::orderBy('majors', 'desc')->first();

    $topJugadores = Jugador::orderBy('mvps', 'desc')
    ->take(3)
    ->get();

    return view('home', compact(
        'totalJugadores',
        'masMvps',
        'masMajors',
        'topJugadores'
    ));
}




    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    $equipos = \App\Models\Equipo::orderBy('nombre')->get();
    return view('jugadores.create', compact('equipos'));
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'nickname'    => 'required|string|max:100',
        'pais'        => 'required|string|max:100',
        'mvps'        => 'required|integer|min:0',
        'majors'      => 'required|integer|min:0',
        'descripcion' => 'nullable|string',
        'equipo_id'   => 'nullable|integer|exists:equipos,id',
        'imagen'      => 'nullable|url|max:500',
    ]);

    $datos = $request->only(['nickname', 'pais', 'mvps', 'majors', 'descripcion', 'equipo_id', 'imagen']);

    Jugador::create($datos);

    return redirect()->route('jugadores.index')
                     ->with('success', '¡Jugador agregado correctamente!');
}

    /**
     * Display the specified resource.
     */
public function show($id)
{
    $jugador = Jugador::find($id);

    return view('jugadores.show', compact('jugador'));
}
    /**
     * Show the form for editing the specified resource.
     */
public function edit($id)
{
    $jugador = Jugador::find($id);
    $equipos = \App\Models\Equipo::orderBy('nombre')->get();

    return view('jugadores.edit', compact('jugador', 'equipos'));
}

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Jugador $jugador)
{
    $request->validate([
        'nickname'    => 'required|string|max:100',
        'pais'        => 'required|string|max:100',
        'mvps'        => 'required|integer|min:0',
        'majors'      => 'required|integer|min:0',
        'descripcion' => 'nullable|string',
        'equipo_id'   => 'nullable|integer|exists:equipos,id',
        'imagen'      => 'nullable|file|image|max:2048',
        'imagen_url'  => 'nullable|url|max:500',
    ]);

    $jugador->nickname    = $request->input('nickname');
    $jugador->pais        = $request->input('pais');
    $jugador->mvps        = $request->input('mvps');
    $jugador->majors      = $request->input('majors');
    $jugador->descripcion = $request->input('descripcion');
    $jugador->equipo_id   = $request->input('equipo_id') ?: null;

    if ($request->boolean('clear_image')) {
        if (!empty($jugador->imagen) && !str_starts_with($jugador->imagen, 'http')) {
            Storage::disk('public')->delete($jugador->imagen);
        }
        $jugador->imagen = null;
    } elseif ($request->hasFile('imagen')) {
        if (!empty($jugador->imagen) && !str_starts_with($jugador->imagen, 'http')) {
            Storage::disk('public')->delete($jugador->imagen);
        }
        $jugador->imagen = $request->file('imagen')->store('jugadores', 'public');
    } elseif ($request->filled('imagen_url')) {
        if (!empty($jugador->imagen) && !str_starts_with($jugador->imagen, 'http')) {
            Storage::disk('public')->delete($jugador->imagen);
        }
        $jugador->imagen = $request->input('imagen_url');
    }

    $jugador->save();

    return redirect()->route('jugadores.index')
                     ->with('success', '¡Jugador actualizado correctamente!');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $jugador = Jugador::find($id);

    $jugador->delete();

    return redirect()->route('jugadores.index');
    }


public function ranking()
{
    $jugadores = Jugador::orderBy('mvps', 'desc')->get();

    return view('ranking', compact('jugadores'));
}




}
