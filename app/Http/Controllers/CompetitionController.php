<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\CompRepository;

use App\Repositories\ArticlesRepository;

use Config;

class CompetitionController extends SiteController
{
    
    public function __construct(CompRepository $c_rep,ArticlesRepository $a_rep) {
        
        parent::__construct(new \App\Repositories\MenusRepository(new \App\Menu));
        //parent::__construct(new \App\Repositories\SlidersRepository(new \App\Slider));
        
        $this->c_rep = $c_rep;
        $this->a_rep = $a_rep;

        
        $this->bar='right';
        $this->template= env('THEME').'.competitions';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitions = $this->getComps();
        
        
        $articles = $this->getArticles();
        
        
        
        $this->contentRightBar = view(env('THEME').'.indexBar')->with('articles' , $articles)->render();

        return $this->renderOutPut();
    }
    
   
    
    public function getArticles(){
        
        $articles = $this->a_rep->geta(['title', 'created_at', 'img','alias'],Config::get('settings.home_blog_count'));
        
        return $articles;
    }

    public function getComps ($alias = FALSE){
        
      $competitions = $this->c_rep->getc(['*'],FALSE, TRUE); 
      $content = view(env('THEME').'.comp')->with('competitions', $competitions)->render();
      $this->vars = array_add($this->vars, 'content', $content);
      
      return $competitions;
        
    }
    
    
    
    /**public function getplaces (){
        
       $places = $this->pp_rep->places;
       
       return $places;

    }**/
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
        $competition = $this->c_rep->onec($alias);


        $content = view(env('THEME').'.competition_content')->with('competition', $competition)->render();
        
        $this->vars = array_add($this->vars, 'content', $content);

        
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
