<?php

namespace App\Http\Controllers;

use App\Training;
use Illuminate\Http\Request;
use App\Http\Requests\TrainingRequest;

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


    public function store(TrainingRequest $request)
    {
        try {
            Training::create($request->all());

            return redirect()->route('external.index')->with('success', 'Formação criada com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar Formação. Por favor, tente novamente.');
        }
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


    public function update(TrainingRequest $request, Training $training)
    {
        try {
            $training->update($request->all());

            return redirect()->route('external.index')->with('success', 'Formação atualizada com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar Formação. Por favor, tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        try {
            $training->delete();

            return redirect()->route('external.index')->with('success', 'Formação eliminada com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao eliminar Formação. Por favor, tente novamente.');
        }
    }

    public function massDelete(Request $request)
    {
        $request->validate([
            'training_ids' => 'required|array',
            'training_ids.*' => 'exists:trainings,id',
        ]);

        try {
            Training::whereIn('id', $request->input('training_ids'))->delete();

            return redirect()->route('external.index')->with('success', 'Formações selecionadas excluídas com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('external.index')->with('error', 'Erro ao excluir Formações selecionadas. Por favor, tente novamente.');
        }
    }
}
