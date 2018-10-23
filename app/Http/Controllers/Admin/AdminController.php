<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

Use Auth;

use Menu;

class AdminController extends \App\Http\Controllers\Controller
{
    protected $p_rep;
    protected $aa_rep;
    protected $c_rep;
    protected $rol_rep;
    protected $pe_rep;
    protected $pp_rep;
    protected $ra_rep;
    protected $user;
    protected $template;
    protected $content = FALSE;
    protected $title;
    protected $vars;
    
    public function __construct(){
        
        $this->user = Auth::user();
        if (!$this->user){
            abort(403);
        }
    }
    

    
     public function renderOutPut(){
         
         
         $menu = $this->getMenu();
         
         $navigation = view(env('THEME').'.admin.navigation')->with('menu',$menu)->render();
         $this->vars = array_add($this->vars,'navigation', $navigation);
         
         if($this->content){
              $this->vars = array_add($this->vars,'content', $this->content);
              }
       $footer=view(env('THEME').'.admin.footer')->render();
       $this->vars=array_add($this->vars,'footer',$footer);
       
       return view($this->template)->with($this->vars);
         
     }      
     
     
     public function getMenu(){
         return Menu::make('adminMenu',function ($menu){
             $menu->add('Новости', array('route'=>'admin.articless.index'));
             $menu->add('Соревнования', array('route'=>'admin.comps.index'));
             $menu->add('Судьи', array('route'=>'admin.judges.index'));
             $menu->add('Пользователи', array('route'=>'admin.users.index'));
             $menu->add('Привилегии', array('route'=>'admin.permissions.index'));
             $menu->add('Дисциплины', array('route'=>'admin.disc.index'));
             $menu->add('Группы', array('route'=>'admin.groups.index'));
            // $menu->add('Оценки', array('route'=>'admin.scores.index'));
             
         });
     }
}
