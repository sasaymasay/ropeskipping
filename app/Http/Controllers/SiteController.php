<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\MenusRepository;

use Menu;

use Slider;

class SiteController extends Controller
{
    protected $m_rep;
    protected $c_rep;
    protected $s_rep;
    protected $a_rep;
    protected $t_rep;
    protected $g_rep;
    protected $n_rep;
    protected $p_rep;
    protected $pp_rep;
    
    protected $keyword;
    protected $meta_desc;
    
   
    
    protected $template;
    
    protected $vars=array();
    
    protected $contentRightBar=FALSE;
    
    protected $contentLeftBar=FALSE;
    
    protected $bar='no';
    
    public function __construct(MenusRepository $m_rep) {
        
        $this->m_rep = $m_rep;
        
    }
    
    
    protected function renderOutPut(){
        
        $menu=$this->getMenu();
        
        //dd($menu);
        
        $navigation=view(env('THEME').'.navigation')->with('menu',$menu)->render();
        
        $this->vars=array_add($this->vars,'navigation',$navigation);
        
        
        
        if($this->contentRightBar){
            
            $rightBar = view(env('THEME').'.rightBar')->with('contentRightBar', $this->contentRightBar)->render();
            
            $this->vars=array_add($this->vars,'rightBar',$rightBar);
        }
         /**if($this->content){
              $this->vars = array_add($this->vars,'content', $this->content);
              }**/
        
         if($this->contentLeftBar){
            
            $leftBar = view(env('THEME').'.leftBar')->with('contentLeftBar', $this->contentLeftBar)->render();
            
            $this->vars=array_add($this->vars,'leftBar',$leftBar);
        }
      $this->vars=array_add($this->vars,'bar',$this->bar); 
      
      
      //$this->vars=array_add($this->vars, 'keywords', $this->keywords);
      //$this->vars=array_add($this->vars, 'meta_desc', $this->meta_desc);
      
      $footer=view(env('THEME').'.footer')->render();
       $this->vars=array_add($this->vars,'footer',$footer); 
        
      return view($this->template)->with($this->vars);  
    }
    
     public function getMenu(){
         
         $menu = $this->m_rep->get();
         
         $mBuilder = Menu::make('Nav', function ($m) use ($menu) {
             
             foreach ($menu as $item){
                 
                 if($item->parent == 0) {
                   $m->add($item->title,$item->path)->id($item->id);     
                 }
                 else {
                     if ($m->find($item->parent)) {
                         $m->find($item->parent)->add($item->title,$item->path)->id($item->id);
                     }
                 }
             }
             
         });
         //dd($mBuilder);
         return $mBuilder;
         
}

}
