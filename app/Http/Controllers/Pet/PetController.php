<?php

namespace App\Http\Controllers\Pet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\PetSeguimientoProcesoInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
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
    public function index(Request $request)
    {
        //
        $asunto = $this->petSeguimientoRepository->getAsunto();
        $getMonths = $this->petSeguimientoRepository->getAllMonths();
        $periodos = $this->petSeguimientoRepository->getCalendarios($request);
        $actividades = $this->petSeguimientoRepository->getActividades();
        // return view('layouts.petlayouts.index', compact('getMonths', 'asunto'));
        return view('layouts.petlayouts.gantt', compact('getMonths', 'asunto', 'periodos', 'actividades'));
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
    public function store(Request $request): JsonResponse
    {
        //
        $orderDetails = $request->only([
            'client',
            'details'
        ]);

        return response()->json(
            [
                'data' => $this->petSeguimientoRepository->storeData($orderDetails)
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
