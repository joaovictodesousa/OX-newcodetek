<?php

namespace App\Http\Controllers;

use App\Models\Sheet;
use Illuminate\Http\Request;


class SheetController extends Controller
{
    public function index()
    {
        $AllSheet = Sheet::all();
        return view('index', ['AllSheet' => $AllSheet]);
    }

    public function create()
    {
        return view('cadastro');
    }

    public function store(Request $request)
    {
        $form = Sheet::FormatDate($request->insemination_date);
        $bithDate = Sheet::BirthPrediction($request->insemination_date);
        
        $data = [
            'tag' => $request->input('tag'),
            'bull_tag' => $request->input('bull_tag'),
            'inseminator_name' => $request->input('inseminator_name'),
            'insemination_date' => $form ,
            'birth_prediction' => $bithDate
        ];

        $validator = Sheet::validateData($data);

        $validated = $validator->validated();
        // dd($validated);
        Sheet::create($validated);

        return redirect()->route('sheet.index');
    }

    public function show(Sheet $sheet)
    {
        return view('show', [
            'sheet' => $sheet
        ]);
    }

    public function edit(Sheet $sheet)
    {
        return view('edit', ['sheet' => $sheet]);
    }

    public function update(Request $request, string $id)
    {
        $form = Sheet::FormatDate($request->insemination_date);
        $bithDate = Sheet::BirthPrediction($request->insemination_date);
        
        $data = [
            'tag' => $request->input('tag'),
            'bull_tag' => $request->input('bull_tag'),
            'inseminator_name' => $request->input('inseminator_name'),
            'insemination_date' => $form ,
            'birth_prediction' => $bithDate
        ];

        $validator = Sheet::validateData($data);
        

        $validated = $validator->validated();
        Sheet::where('id', $id)->update($validated);

        return redirect()->route('sheet.index');
    }

    public function destroy(string $id)
    {
        //
    }
}