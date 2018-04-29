<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Atividade;
use App\Status;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('atividade.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $atividades = Atividade::orderBy('created_at','desc')
                                ->with('status_synonym')
                                ->get();

        return $atividades;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status()
    {
        $status = Status::all();

        return $status;
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

        $request->validate([
            'nome' => 'required|max:10',
            'descricao' => 'required|max:15'
        ]);

        $data_fim = null;

        if($request->dt_fim != null && strlen($request->dt_fim) > 0)
            $data_fim = new \Carbon\Carbon($request->dt_fim);

        $data_inicio = new \Carbon\Carbon($request->dt_inicio);

        if(isset($request->id) && strlen($request->id) > 0)
        {
            $atividade = Atividade::find($request->id);
            $atividade->fill($request->all());
        }
        else
        {
            $atividade = new Atividade($request->all());
        }

        $atividade->dt_inicio = $data_inicio;
        $atividade->dt_fim = $data_fim;

        $atividade->save();

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
        $atividade = Atividade::find($id);
        $atividade->delete();
        return '1';
    }
}
