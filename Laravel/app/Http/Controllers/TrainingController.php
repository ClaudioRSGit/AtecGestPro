<?php

namespace App\Http\Controllers;

use App\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{

    public function index()
    {
        $trainings = Training::paginate(5);
        return view('trainings.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('trainings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);

        Training::create($request->all());

        return redirect()->route('external.index')->with('success', 'Formação criada com sucesso');
    }




    public function show(Training $training)
    {

        return view('trainings.show', compact('training'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {

        return view('trainings.edit', compact('training'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {

        $this->validate(request(),
            [
                'name' => 'required',
                'description' => 'required',
                'category' => 'required',

            ]);
        $training->update($request->all());
        return redirect()->route('external.index')->with('success', 'Formação atualizada com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
       // $training->partnerTrainingUsers()->delete();
        $training->delete();
        return redirect()->back()->with('success','Formação eliminada com sucesso');
    }

    public function massDelete(Request $request)
    {

//        dd($request->all());

        $request->validate([
            'training_ids' => 'required|array',
            'training_ids.*' => 'exists:trainings,id',]);

//        dd($request->all());

        try {
            Training::whereIn('id', $request->input('training_ids'))->delete();

            return redirect()->back()->with('success', 'Formações selecionadas excluídas com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir Formações selecionadas. Por favor, tente novamente.');
        }
    }
}
