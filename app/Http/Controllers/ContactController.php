<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Mail;



class ContactController extends SiteController
{
    public function __construct() {
        
        parent::__construct(new \App\Repositories\MenusRepository(new \App\Menu));
        //parent::__construct(new \App\Repositories\SlidersRepository(new \App\Slider));   
        $this->bar='left';
        $this->template= env('THEME').'.contacts';
    }
   
     public function index(Request $request){
         
        
         if($request->isMethod('post')){
             $messages = [
                         'required' => 'Поле :attribute обязательно к заполнению!',
                         'email' => 'Поле :attribute должно содержать правильный E-mail!',
             ];
             
             $this->validate($request,[
                     'name' => 'required|max:255',
                     'email' => 'required|email',
                     'message' => 'required'
                     ]/*$messages*/);
             $data = $request->all();
             
             $result = Mail::send(env('THEME').'.email', ['data'=>$data], function($m) use ($data){
                 $mail_admin = env('MAIL_ADMIN');
                 
                 $m->from($data['email'], $data['name']);
                 
                 $m->to($mail_admin, 'Mr.Admin')->subject('Question');
             });
             if (!$result) {
                 return redirect()->route('contacts')->with('status', 'E-mail отправлен');
             }
         }
         
         
  
      $content = view(env('THEME').'.contact_content')->render();
      $this->vars = array_add($this->vars, 'content', $content);
      $this->contentLeftBar = view(env('THEME').'.contact_Bar')->render();
      
      return $this->renderOutPut();

     
}
    
    
    
    
}
 /**$competition = Competition::get();

        foreach ($competition->places as $place) {
            echo $place->place;
        }
    }**/