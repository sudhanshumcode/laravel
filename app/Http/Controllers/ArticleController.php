<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dotenv\Validator as DotenvValidator;
use Validator;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles=Article::orderBy("id","desc")->paginate("5");
        
        return response()->json($articles,200);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $res)
    {
        //
        $validator =Validator::make($res->all(),[
            "title" =>"required",

        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),202);
        }
        $article=Article::create([
            "title"=> $res->title,
            "body" =>$res->body
        ]);
        return response()->json($article,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $articles=Article::findOrFail($id);
        
        return response()->json($articles,200);
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
        $articles=Article::findOrFail($id);
        
        return response()->json(articles,200);
        
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
        
       $validator=Validator::make($request->all(),[
        "title"=>"required",
       ]);
        if($validator->fails()){
            return response()->json($validator->errors(),202);
        }
        $article=Article::find($id);
        $article->update($request->all());  
        return response()->json($article,200);
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
        $article = Article::findOrFail($id);

        if ($article->delete()) {
            return response()->json(["status"=>"true"],200);
        }
    }
}
