<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Repositories\ArticlesRepository;

use Gate;

use App\Article;



class ArticlesController extends AdminController
{
    public function __construct(ArticlesRepository $a_rep){
        parent::__construct();
        
        if(Gate::denies('VIEW_ADMIN_ARTICLES')){
            abort(403);
        }
        
        $this->a_rep = $a_rep;
        
        $this->template = env('THEME').'.admin.articles';
        
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $articles = $this->getArticles();
        $this->content = view(env('THEME').'.admin.articles_content')->with('articles',$articles)->render();
        
        return $this->renderOutPut();
    }
    
    public function getArticles()
    {
        
        
        return $this->a_rep->geta();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('save', new \App\Article)){
            abort(403);
            
        }
        $this->content = view(env('THEME').'.admin.articles_create_content')->render();
        
        return $this->renderOutPut();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
       $result = $this->a_rep->addArticle($request);
       
       if(is_array($result) && !empty($result['error'])){
           return back()->with($result);
       }
       return redirect('/admin')->with($result);
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
    public function edit(Article $article)
    {
        // $article = $this->a_rep->one($alias);
   //$article = new Article::where('alias',$alias);    
    if (Gate::denies('edit', new Article)){
        abort(403);
    }
    
    $article->img = json_decode($article->img);
   
    
    $this->content = view(env('THEME').'.admin.articles_create_content')->with('article', $article)->render();
        
        return $this->renderOutPut();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
       $result = $this->a_rep->updateArticle($request,$article);
       
       if(is_array($result) && !empty($result['error'])){
           return back()->with($result);
       }
       return redirect('/admin')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $result = $this->a_rep->deleteArticle($article);
       
       if(is_array($result) && !empty($result['error'])){
           return back()->with($result);
       }
       return redirect('/admin')->with($result);
    }
}
