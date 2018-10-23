<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\SlidersRepository;

use App\Repositories\PortfoliosRepository;

use App\Repositories\ArticlesRepository;

use Config;

class IndexController extends SiteController
{
    
     public function __construct(SlidersRepository $s_rep, PortfoliosRepository $p_rep, ArticlesRepository $a_rep) {
        
        parent::__construct(new \App\Repositories\MenusRepository(new \App\Menu));
        //parent::__construct(new \App\Repositories\SlidersRepository(new \App\Slider));
        
        $this->s_rep = $s_rep;
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
       
        $this->bar='right';
        $this->template= env('THEME').'.index';
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = $this->getPortfolios(); 
        $content = view(env('THEME').'.content')->with('portfolios' , $portfolios)->render();
        $this->vars = array_add($this->vars, 'content', $content);
        
        $sliderItems = $this->getSliders();
        $sliders = view(env('THEME').'.slider')->with('sliders', $sliderItems)->render();
        $this->vars=array_add($this->vars, 'sliders', $sliders);
        
        $this->keywords = 'Home Page';
        $this->meta_desc = 'Home Page';
        
        
        $articles = $this->getArticles();
        
        $this->contentRightBar = view(env('THEME').'.indexBar')->with('articles' , $articles)->render();
        
        
        return $this->renderOutPut();
    }
    
    public function getArticles(){
        $articles = $this->a_rep->geta(['title', 'created_at', 'img','alias'],Config::get('settings.home_blog_count'));
         if ($articles){
          
          $articles->load('user');
      }
        
        return $articles;
        
    }
    
    public function getPortfolios(){
        
        $portfolios = $this->p_rep->getp('*',Config::get('settings.home_port_count'));
         
        
        return $portfolios;
    }
    
    

    public function getSliders (){
        
        $sliders = $this->s_rep->gets();
        
        if($sliders->isEmpty())  {
            return FALSE;
        }
          $sliders->transform(function($item, $key) {
              
              $item->img = Config::get('settings.slider_path').'/'.$item->img;
              return $item;
          });    
          
          //dd($sliders);
        
        return $sliders;
        
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
        //
    }
}
