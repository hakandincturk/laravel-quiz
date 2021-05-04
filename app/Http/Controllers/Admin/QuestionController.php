<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

//REQUESTS
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;

//MODELS
use App\Models\Quiz;

class QuestionController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $quiz =  Quiz::whereId($id)->with('questions')->first() ?? abort(404,'Quiz Bulunamadı');
        return view('admin.question.list', compact('quiz'));
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $quiz = Quiz::find($id);
        return view('admin.question.create', compact('quiz'));
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request, $id)
    {
        if ($request->hasFile('image')){
            $fileName=Str::slug($request->question).'_'.date_timestamp_get(date_create()).'.'.$request->image->extension();
            $fileNameWithUpload='uploads/'.$fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image'=>$fileNameWithUpload
            ]);
        }
        Quiz::find($id)->questions()->create($request->post());

        return redirect()->route('questions.index', $id)->withSuccess('Soru başarıyla güncellendi.');
    }

    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quizId, $questionId)
    {
        $question =  Quiz::find($quizId)->questions()->whereId($questionId)->first() ?? abort(404, 'Quiz veya soru bulunamadı.');
        return view('admin.question.edit', compact('question'));
    }

    /*
     * Update the specified resource in storage.
     *
     * @param\Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $quizId, $questionId)
    {
        if ($request->hasFile('image')){
            $fileName=Str::slug($request->question).'_'.date_timestamp_get(date_create()).'.'.$request->image->extension();
            $fileNameWithUpload='uploads/'.$fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image'=>$fileNameWithUpload
            ]);
        }
        Quiz::find($quizId)->questions()->whereId($questionId)->first()->update($request->post());

        return redirect()->route('questions.index', $quizId)->withSuccess('Soru başarıyla güncellendi.');
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quizId, $questionId)
    {
        Quiz::find($quizId)->questions()->whereId($questionId)->delete();
        return redirect()->route('questions.index', $quizId)->withSuccess('Soru başarıyla silindi.');
    }
}
