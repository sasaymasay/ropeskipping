<?php

namespace App\Repositories;

use App\Competition;

use Gate;


class CompRepository extends Repository {

    public function __constuct(Competition $competition) {
        $this->cmodel = $competition;
    }
     public function one($alias,$attr = array()) {
		$article = parent::one($alias,$attr);
		
		return $article;
	}
    
     public function addCompetition($request){
        if (Gate::denies('create', new Competition)){
            abort(403);
        }
        $data = $request->except('_token');
        
        /**$competition = Competition::create([
            'title'=>$data['title'],
            'organizator'=>$data['organizator'],
            'info'=>$data['info'],
            'city'=>$data['city'],
            'adress'=>$data['adress'],
            'place'=>$data['place'],
            'alias'=>$data['alias'] = $this->transliterate($data['title'])
        ]);**/
        
        if (empty($data['alias'])) {
            $data['alias'] = $this->transliterate($data['title']);
        }

        if ($this->onec($data['alias'], FALSE)) {
            $request->merge(array('alias' => $data['alias']));
            $request->flash();
            return ['error' => 'Данный псевдоним уже используется'];
        }
        
        
        $this->cmodel->fill($data);
        
        if ($request->user()->competitions()->save($this->cmodel)) {

        return ['status' => 'Соревнование добавлено'];
        }
        
     }

     
                
    
    public function updateCompetition($request, $competition){
        if(Gate::denies('edit', new Competition)){
            abort(403);
        }
         $data = $request->except('_token', '_method', 'user_id');

        if (empty($data)) {
            return array('error' => 'Нет данных');
        }

        if (empty($data['alias'])) {
            $data['alias'] = $this->transliterate($data['title']);
        }
        $resul = $this->onec($data['alias'], FALSE);

        if (isset($resul->id) && ($resul->id != $competition->id)) {
            $request->merge(array('alias' => $data['alias']));
            $request->flash();
            return ['error' => 'Данный псевдоним уже используется'];
        }
        
        $competition->fill($data);

        if ($competition->update()) {

            return ['status' => 'Соревнование обновлено'];
        }
    }
    
    public function deleteCompetition($competition){
        
    if(Gate::denies('edit',$competition)){
            abort(403);
        }
        
        if($competition->delete()){
            
            return ['status' => 'Соревнование удалено'];
        }
    }
}
