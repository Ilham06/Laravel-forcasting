<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forcasting;
use Illuminate\Support\Arr;

class ForcastingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $forcastings = Forcasting::all();

        return view('forcasting', [
            'forcastings' => $forcastings,
            'mape' => [],
            'mapeSort' => []
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
        Forcasting::create([
            'periode' => $request->periode,
            'aktual' => $request->harga,
        ]);

        return redirect()->route('forcasting.index');
    }

    public function hitung()
    {
        $a = 0.1;

        $forcastings = Forcasting::where('f', 0)->get();

        foreach ($forcastings as $forcasting) {
            
            // cek apakah data pertama?
            $isFirst = Forcasting::find($forcasting->id - 1);

            $rowForcasting = Forcasting::find($forcasting->id);

            if (!$isFirst) {
                $rowForcasting->s1 = $rowForcasting->aktual;
                $rowForcasting->s2 = $rowForcasting->aktual;
                $rowForcasting->a = $rowForcasting->aktual;
                $rowForcasting->b = 0;
                $rowForcasting->save();

            } else {
                // get data sebelumnya
                $prevData = Forcasting::find($forcasting->id -1);

                // hitung s1
                $rowForcasting->s1 = ($forcasting->aktual * $a) + (1 - $a) * $prevData->s1;
                $rowForcasting->save();

                // hitung s2
                $rowForcasting->s2 = ($rowForcasting->s1 * $a) + (1 - $a) * $prevData->s2;
                $rowForcasting->save();

                // hitung a
                $rowForcasting->a = 2 * $rowForcasting->s1 - $rowForcasting->s2;
                $rowForcasting->save();

                // hitung b
                $rowForcasting->b = $a / (1 - $a) * ($rowForcasting->s1 - $rowForcasting->s2);
                $rowForcasting->save();

                // hitung f
                $rowForcasting->f = $prevData->a + ($prevData->b * 1);
                $rowForcasting->save();

                // hitung xt_ft
                $rowForcasting->xt_ft = abs($rowForcasting->aktual - $rowForcasting->f);
                $rowForcasting->save();

                // hitung PE 
                $rowForcasting->pe = ($rowForcasting->xt_ft / $rowForcasting->aktual)*100;
                $rowForcasting->save();
            }
        }
        

        return redirect()->route('forcasting.index');
    }

    public function ramal() 
    {
        $lastData = Forcasting::orderby('created_at', 'desc')->first();
        $year = $lastData->periode + 1;
        $f = $lastData->a + ($lastData->b * 1);

        $fcount = Forcasting::all()->count();
        $mape = Forcasting::all()->sum('pe');
        $mape = $mape/$fcount;

        $message = 'Prediksi Panen Tahun ' . $year . ' Adalah ' . $f . ', dengan mape sebesar ' . $mape;
        
        return redirect()->route('forcasting.index')->with('message', $message);
    }

    public function reset()
    {
        $forcastings = Forcasting::all();

        foreach ($forcastings as $forcasting) {
            $forcasting->s1 = 0;
            $forcasting->s2 = 0;
            $forcasting->a = 0;
            $forcasting->b = 0;
            $forcasting->f = 0;
            $forcasting->xt_ft = 0;
            $forcasting->pe = 0;
            $forcasting->save();
        }

        return redirect()->route('forcasting.index');
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
