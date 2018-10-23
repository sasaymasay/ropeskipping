<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\AdminDisciplineRepository;

use App\Repositories\AdminGroupsRepository;

use App\Discipline;

use App\Group;

use Gate;

class DisciplinesController extends AdminController
{
    
    protected $d_rep;
    protected $gr_rep;

    
    public function __construct(AdminDisciplineRepository $d_rep, AdminGroupsRepository $gr_rep){
        parent::__construct();
        
        if (Gate::denies('EDIT_DISCIPLINES')) {
            abort(403);
        }
        

        $this->d_rep = $d_rep;
        $this->gr_rep = $gr_rep;
        
        $this->template = env('THEME').'.admin.disciplines';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $disciplines = $this->d_rep->getd();
        $groups = $this->gr_rep->getgr();
        
        $this->content = view(env('THEME').'.admin.disciplines_content')->with(['disciplines'=>$disciplines,'groups'=>$groups])->render();
        
        return $this->renderOutPut();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (Gate::denies('create', new \App\Discipline)){
            abort(403);
            
        }
          $groups = $this->getGroups()->reduce(function($returnGroups, $group){
            $returnGroups[$group->id] = $group->name;
            return $returnGroups;
        },[]);
            
        $this->content = view(env('THEME').'.admin.discipline_create_content')->with('groups',$groups)->render();
        
        return $this->renderOutPut();
    }
    
    public function getGroups(){
        return \App\Group::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->d_rep->addDiscipline($request);
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
    public function edit(Discipline $discipline)
    {
        $groups = $this->getGroups()->reduce(function($returnGroups, $group){
        $returnGroups[$group->id] = $group->name;
        return $returnGroups;
         },[]);
        
        $this->content = view(env('THEME').'.admin.discipline_create_content')->with(['discipline'=>$discipline,'groups'=>$groups])->render();
        
        return $this->renderOutPut();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $discipline)
    {
        $result = $this->d_rep->updateDiscipline($request, $discipline);
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
    public function destroy(Discipline $discipline)
    {
        $result = $this->d_rep->deleteDiscipline($discipline);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }
}
