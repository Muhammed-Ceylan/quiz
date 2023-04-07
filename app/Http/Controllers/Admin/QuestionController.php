<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionCreateRequest;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $id)
    {
        $quiz = Quiz::whereId($id)->with('questions')->first() ?? abort(404, 'Quiz Bulunamadı');
        return view('admin.question.list', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $id)
    {
        $quiz = Quiz::find($id);
        return view('admin.question.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionCreateRequest $request, int $id)
    {
        //resim varsa uploads dosyası içerisine fotoğraf ekleniyor
        //slug ile sorunun ismi ile uzantısı birleştiriliyor. foto.jpg gibi
        //uploads dosyası içerisine uploads/foto.jpg gibi ekleniyor.
        //public_path public dosyası içerisindeki uploads dosyası içerisine 
        //fileName değerini yazıyor ve move fonksiyonu ile dosya belirtilen hedefe gidiyor.
        //veritabanında image alanına ilgili güncel name değerini gönderir. Override
        if ($request->hasFile('image')) {
            $fileName = Str::slug($request->question) . '.' . $request->image->extension();
            $fileNameWithUpload = 'uploads/' . $fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $fileNameWithUpload,
            ]);
        }

        Quiz::find($id)->questions()->create($request->post());

        return redirect()->route('questions.index', $id)
            ->withSuccess('Soru başarılı şekilde oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
