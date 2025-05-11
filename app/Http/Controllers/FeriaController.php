<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feria;
use App\Models\Emprendedor;


class FeriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            $ferias = Feria::all();
            return view('ferias.index', compact('ferias'));
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to fetch ferias: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $emprendedores = Emprendedor::all();
        return view('ferias.create', compact('emprendedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{

            $request->validate([
                'nombre' => 'required|string|max:255',
                'description' => 'nullable|string',
                'fecha_evento' => 'nullable|string',
                'lugar' => 'nullable|string',
                'emprendedores' => 'nullable|array',
                'emprendedores.*' => 'exists:emprendedores,id',
            ]);

            $feria = Feria::create($request->only(['nombre', 'descripcion', 'fecha_evento', 'lugar']));

            $feria->emprendedores()->sync($request->input('emprendedores', []));


            return redirect()->route('ferias.index')->with('success', 'Feria created successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create feria: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try{
            $feria = Feria::findOrFail($id);
            return view('ferias.show', compact('feria'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Feria not found: ' . $e->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    try {
        $feria = Feria::findOrFail($id);
        $emprendedores = Emprendedor::all();

        return view('ferias.edit', compact('feria', 'emprendedores'));
    } catch (\Exception $e) {
        return response()->json(['error' => 'Feria not found: ' . $e->getMessage()], 404);
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge([
            'emprendedores' => array_filter($request->input('emprendedores', []), function ($id) {
                return $id !== '__none__';
            })
        ]);
        try{


            $request->validate([
                'nombre' => 'required|string|max:255',
                'description' => 'nullable|string',
                'fecha_evento' => 'nullable|string',
                'lugar' => 'nullable|string',
                'emprendedores' => 'nullable|array',
                'emprendedores.*' => 'exists:emprendedores,id',
            ]);

            $feria = Feria::findOrFail($id);
            $feria->update($request->only(['nombre', 'descripcion', 'fecha_evento', 'lugar']));
            $feria->emprendedores()->sync($request->input('emprendedores', []));

            return redirect()->route('ferias.index')->with('success', 'Feria updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update feria: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try{
            $feria = Feria::findOrFail($id);
            $feria->delete();

            return redirect()->route('ferias.index')->with('success', 'Feria deleted successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete feria: ' . $e->getMessage()], 500);
        }
    }
}
