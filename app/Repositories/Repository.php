<?php

namespace App\Repositories;

use Config;

//use App\Http\Controllers\CompetitionController;



abstract class Repository {
    
  public $mmodel = FALSE;
  public $smodel = FALSE;
  public $cmodel = FALSE;
  public $pmodel = FALSE;
  public $amodel = FALSE;
  public $pemodel = FALSE;
  public $rmodel = FALSE;
  public $ramodel;
  public $gmodel;
  public $jmodel;
  public $dmodel;
  public $agmodel;
  public $grmodel;
  public $remodel;
     
  
   
   public function get(){
       
     
      $this->mmodel = new \App\Menu; 
       
    
      $mebuilder = $this->mmodel->select('*');
      
          return $mebuilder->get();
      

}

   public function gett(){
       
     
      $this->tmodel = new \App\Team; 
       
    
      $tbuilder = $this->tmodel->select('*');
      
          return $tbuilder->get();
      

}

  public function getre($select = '*', $take = FALSE, $pagination = FALSE) {



        $this->remodel = new \App\Result;




        $rebuilder = $this->remodel->select($select)->orderBy('group_id', 'asc')->select($select)->orderBy('discipline_id', 'asc')->select($select)->orderBy('age_id', 'desc')->select($select)->orderBy('final_score', 'desc');


        if ($take) {

            $rebuilder->take($take);
        }

        if ($pagination) {

            return $this->check($rebuilder->paginate(Config::get('settings.cpaginate')));
        }
        return $this->check($rebuilder->get());
    }
    
  public function getres($select = '*', $take = FALSE, $pagination = FALSE) {



       // $this->remodel = \App\Result::where('discipline_id', '=', );


        $pattern = $result->discipline->name;

        $rebuilder = $this->remodel->select($select);


        if ($take) {

            $rebuilder->take($take);
        }

        if ($pagination) {

            return $this->check($rebuilder->paginate(Config::get('settings.cpaginate')));
        }
        return $this->check($rebuilder->get());
    }

   public function getj(){
       
     
      $this->jmodel = new \App\Judge; 
       
    
      $jbuilder = $this->jmodel->select('*');
      
          return $jbuilder->get();
      
}

   public function getgr(){
       
     
      $this->grmodel = new \App\Group; 
       
    
      $grbuilder = $this->grmodel->select('*');
      
          return $grbuilder->get();
      
}

   public function getag(){
       
     
      $this->agmodel = new \App\Age; 
       
    
      $agbuilder = $this->agmodel->select('*');
      
          return $agbuilder->get();
      
}

   public function getd(){
       
     
      $this->dmodel = new \App\Discipline; 
       
    
      $dbuilder = $this->dmodel->select('*');
      
          return $dbuilder->get();
      

}

   public function getg(){
       
     
      $this->gmodel = new \App\Gender; 
       
    
      $gbuilder = $this->gmodel->select('*');
      
          return $gbuilder->get();
      

}

   public function getra(){
       
     
      $this->ramodel = new \App\Rank; 
       
    
      $rabuilder = $this->ramodel->select('*');
      
          return $rabuilder->get();
      

}
   public function gets(){
       
     
     
      $this->smodel = new \App\Slider; 
    
     
      
          
          $sbuilder = $this->smodel->select('*');
      
  
      return $sbuilder->get();
    
   
}

   public function getr($select = '*', $take = FALSE, $pagination = FALSE) {



        $this->rmodel = new \App\Role;




        $rbuilder = $this->rmodel->select($select);


        if ($take) {

            $rbuilder->take($take);
        }

        if ($pagination) {

            return $this->check($rbuilder->paginate(Config::get('settings.paginate')));
        }
        return $this->check($rbuilder->get());
    }
    
    
   public function getu($select = '*', $take = FALSE, $pagination = FALSE) {



        $this->umodel = new \App\User;




        $ubuilder = $this->umodel->select($select);


        if ($take) {

            $ubuilder->take($take);
        }

        if ($pagination) {

            return $this->check($ubuilder->paginate(Config::get('settings.paginate')));
        }
        return $this->check($ubuilder->get());
    }
    
    
   public function getpe($select = '*', $take = FALSE, $pagination = FALSE) {



        $this->pemodel = new \App\Permission;




        $pebuilder = $this->pemodel->select($select);


        if ($take) {

            $pebuilder->take($take);
        }

        if ($pagination) {

            return $this->check($pebuilder->paginate(Config::get('settings.paginate')));
        }
        return $this->check($pebuilder->get());
    }

  
  
  

   
public function getc($select = '*', $take = FALSE, $pagination = FALSE) {



        $this->cmodel = new \App\Competition;




        $cbuilder = $this->cmodel->select($select);


        if ($take) {

            $cbuilder->take($take);
        }

        if ($pagination) {

            return $this->check($cbuilder->paginate(Config::get('settings.paginate')));
        }
        return $this->check($cbuilder->get());
    }
    


    public function geta($select = '*', $take = FALSE, $pagination = FALSE){
       
     
     
      $this->amodel = new \App\Article; 
    
     
      
          
          $abuilder = $this->amodel->select($select);
          
          
          if($take){
              
              $abuilder->take($take);
          }
          
          if($pagination) {
              
              return $this->check($abuilder->paginate(Config::get('settings.paginate')));
          }
      
  
      return $this->check($abuilder->get());
   }
   
    
  
   
   public function getp($select = '*', $take = FALSE){
       
     
   
      $this->pmodel = new \App\Portfolio; 
    
     
      
          
          $pbuilder = $this->pmodel->select($select);
          
          
          if($take){
              
              $pbuilder->take($take);
          }
      
  
      return $this->check($pbuilder->get());
    
   
}

protected function check($result){
    
   if ($result->isEmpty()){
       
       return FALSE;
   } 
   $result->transform(function($item, $key){
       $item->img = json_decode($item->img);
       
       return $item;
       
   });
   
   return $result;
}

public function one($alias){
    
    $this->amodel = new \App\Article; 
    $result = $this->amodel->where('alias', $alias)->first();
    return $result;
}
public function onec($alias){
    
    $this->cmodel = new \App\Competition; 
    $result = $this->cmodel->where('alias', $alias)->first();
    return $result;
}


public function transliterate($string){
    $str = mb_strtolower($string, 'UTF-8');
    
    $letter_array =[
            'a'=>'а',
            'b'=>'б',
            'v'=>'в',
            'g'=>'г',
            'd'=>'д',
            'e'=>'е,э',
            'zh'=>'ж',
            'z'=>'з',
            'i'=>'и',
            'j'=>'й',
            'k'=>'к',
            'l'=>'л',
            'm'=>'м',
            'n'=>'н',
            'o'=>'о',
            'p'=>'п',
            'r'=>'р',
            's'=>'с',
            't'=>'т',
            'u'=>'у',
            'f'=>'ф',
            'h'=>'х',
            'c'=>'ц',
            'ch'=>'ч',
            'sh'=>'ш',
            'sch'=>'щ',
            ''=>'ъ',
            'y'=>'ы',
            ''=>'ь',
            'yu'=>'ю',
            'ya'=>'я'

            ];
    foreach ($letter_array as $letter =>$kir){
       $kir = explode(',',$kir);
       
       $str = str_replace($kir,$letter,$str);
        
    }
    
    $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/','-',$str);
    
    $str = trim($str,'-');
    
    return $str;
    
}


}
