<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emprendedor;
use App\Models\Feria;


class EmprendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            $emprendedores = Emprendedor::all();
            return view('emprendedores.index', compact('emprendedores'));
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to fetch emprendedores: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $ferias = Feria::all();
        return view('emprendedores.create', compact('ferias'));
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
                'telefono' => 'nullable|string',
                'rubro' => 'nullable|string',
                'ferias' => 'nullable|array',
                'ferias.*' => 'exists:ferias,id',
            ]);
            $emprendedor = Emprendedor::create($request->only(['nombre', 'telefono', 'rubro']));
            $emprendedor->ferias()->sync($request->input('ferias', []));

            return redirect()->route('emprendedores.index')->with('success', 'Emprendedor created successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create emprendedor: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try{
            $emprendedor = Emprendedor::findOrFail($id);
            return view('emprendedores.show', compact('emprendedor'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Emprendedor not found: ' . $e->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try{
            $emprendedor = Emprendedor::with('ferias')->findOrFail($id);
            $ferias = Feria::all();

            return view('emprendedores.edit', compact('emprendedor', 'ferias'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Emprendedor not found: ' . $e->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{

            $request->validate([
                'nombre' => 'required|string|max:255',
                'telefono' => 'nullable|string',
                'rubro' => 'nullable|string',
                'ferias' => 'nullable|array',
                'ferias.*' => 'exists:ferias,id',
            ]);

            $emprendedor = Emprendedor::findOrFail($id);
            $emprendedor->update($request->only(['nombre', 'telefono', 'rubro']));

            $emprendedor->ferias()->sync($request->input('ferias', []));
            return redirect()->route('emprendedores.index')->with('success', 'Emprendedor updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update emprendedor: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try{
            $emprendedor = Emprendedor::findOrFail($id);
            $emprendedor->delete();

            return redirect()->route('emprendedores.index')->with('success', 'Emprendedor deleted successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete emprendedor: ' . $e->getMessage()], 500);
        }
    }
}
