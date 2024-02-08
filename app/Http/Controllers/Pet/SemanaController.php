<?php

namespace App\Http\Controllers\Pet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\PetSeguimientoProcesoInterface;
use App\Http\Requests\CatSemanaRequest;

class SemanaController extends Controller
{
    private PetSeguimientoProcesoInterface $petSeguimientoRepository;
    public function __construct(PetSeguimientoProcesoInterface $PetSeguimientoRepository)
    {
        $this->petSeguimientoRepository = $PetSeguimientoRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $catSemanas = $this->petSeguimientoRepository->getSemana();
        return view('layouts.petlayouts.semanaCat', compact('catSemanas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatSemanaRequest $request): JsonResponse
    {
        $semanaObject = $request->only([
            'semana',
            'ejercicio',
            'fechaInicio',
            'fechaFin',
            'activo'
        ]);
        return response()->json(
            [
                'data' => $this->petSeguimientoRepository->saveCatSemana($semanaObject)
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
