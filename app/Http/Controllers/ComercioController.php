<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use App\Models\Transaccions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComercioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchant = Comercio::all();
        return response()->json([
            'success'=>true,
            'message'=>'records founded',
            'data'=> $merchant,
        ]);
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
        $merchant = new Comercio;
        $merchant->merchant_name = $request->merchant_name;
        $merchant->comision = $request->comision;
        $merchant->save();

        return response()->json([
            "message" => "Merchant created",
            "struct" => $merchant,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function show(Comercio $comercio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function edit(Comercio $comercio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comercio $comercio, $id)
    {
        if (Comercio::where('id', $id)->exists()) {
            $merchant = Comercio::find($id);

            $merchant->update($request->all());

            return response()->json([
              "message" => "Merchant updated successfully",
              "struct" => $merchant,
            ], 200);
          } else {
            return response()->json([
              "message" => "Merchant not found"
            ], 404);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comercio $comercio)
    {
        //
    }

    public function getBanwire(){
        $money = DB::table('transaccions')->sum('fee');
        return response()->json([
            "message" => "All comision to banwire",
            "struct" => $money,
          ], 200);
    }


}
