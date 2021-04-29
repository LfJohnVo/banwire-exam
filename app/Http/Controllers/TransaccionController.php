<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comercio;

class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $tarifa = ($request->amount * $request->comision) / 100;

        $tranc = new Transaccion;
        $tranc->comercio_id = $request->comercio_id;
        $tranc->amount = $request->amount;
        $tranc->comision = $request->comision;
        $tranc->fee = $tarifa;
        $tranc->save();

        return response()->json([
            "message" => "Transaction created",
            "struct" => $tranc,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function show(Transaccion $transaccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaccion $transaccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaccion $transaccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaccion $transaccion)
    {
        //
    }

    public function getMercComision($id){
        if ( $tranc = Transaccion::where('comercio_id', $id)->exists()) {
            $comercio = Comercio::find($id);

            $trancs = DB::table('transaccions')
            ->where('comercio_id', '=', $id)
            ->sum('amount');

            $fee = DB::table('transaccions')
            ->where('comercio_id', '=', $id)
            ->sum('fee');


            return response()->json([
                "message" => "balance: " . $comercio->merchant_name,
                "struct" => $trancs - $fee,
            ], 201);
          } else {
            return response()->json([
              "message" => "Book not found"
            ], 404);
          }
    }
}
