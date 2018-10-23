<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\ArticlesRepository;

use App\Repositories\PortfoliosRepository;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep, ArticlesRepository $a_rep) {
        
        parent::__construct(new \App\Repositories\MenusRepository(new \App\Menu));
        //parent::__construct(new \App\Repositories\SlidersRepository(new \App\Slider));
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
       
        $this->bar='right';
        $this->template= env('THEME').'.articles';
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->getArticles();
        
        
       // $content = view(env('THEME').'.articles_content')->with('articles', $articles)->render();
       // $this->vars = array_add($this->vars, 'content', $content);
        
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        
        $this->contentRightBar = view(env('THEME').'.articlesBar')->with('portfolios', $portfolios);
        
        return $this->renderOutPut();
        
    }
    public function getPortfolios($take){
        
        $portfolios = $this->p_rep->getp(['title', 'text', 'alias', 'img'], $take);
      
        
        return $portfolios;
    }
    
    
    public function getArticles($alias = FALSE){
        
      $articles = $this->a_rep->geta(['title','alias','created_at','img','disc','user_id'],FALSE, TRUE); 
     
      $content = view(env('THEME').'.articles_content')->with('articles', $articles)->render();
      $this->vars = array_add($this->vars, 'content', $content);
      
      if ($articles){
          
          $articles->load('user');
      }
      return $articles;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($alias)
    {   
        $article = $this->a_rep->one($alias);
        if($article){
            $article->img = json_decode($article->img);
        }
        if(isset($article->id)){
            $this->title = $article->title;
        }
        
        $content = view(env('THEME').'.article_content')->with('article', $article)->render();
        $this->vars = array_add($this->vars, 'content', $content);
        
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        
        $this->contentRightBar = view(env('THEME').'.articlesBar')->with('portfolios', $portfolios);
        
        return $this->renderOutPut();
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
