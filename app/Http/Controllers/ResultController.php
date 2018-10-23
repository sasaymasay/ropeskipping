<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Result;

use App\Repositories\CompRepository;
use App\Repositories\AdminDisciplineRepository;
use App\Repositories\AdminGroupsRepository;
use App\Repositories\AdminUsersRepository;
use App\Repositories\RanksRepository;
use App\Repositories\GendersRepository;
use App\Repositories\AdminAgesRepository;
use App\Repositories\ResultRepository;








class ResultController extends SiteController
{
    protected $c_rep;
    protected $d_rep;
    protected $gr_rep;
    protected $us_rep;
    protected $ra_rep;
    protected $g_rep;
    protected $re_rep;
    protected $ag_rep;

 
    
    
     public function __construct(ResultRepository $re_rep, AdminUsersRepository $us_rep, CompRepository $c_rep,AdminDisciplineRepository $d_rep, AdminGroupsRepository $gr_rep, RanksRepository $ra_rep, GendersRepository $g_rep, AdminAgesRepository $ag_rep) {
        
        parent::__construct(new \App\Repositories\MenusRepository(new \App\Menu));
        //parent::__construct(new \App\Repositories\SlidersRepository(new \App\Slider));
        
        $this->c_rep = $c_rep;
        $this->d_rep = $d_rep;
        $this->gr_rep = $gr_rep;
        $this->us_rep = $us_rep;
        $this->ra_rep = $ra_rep;
        $this->g_rep = $g_rep;
        $this->ag_rep = $ag_rep;
        $this->us_rep = $us_rep;
        $this->re_rep = $re_rep;


        $this->template= env('THEME').'.results';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        
        $competitions = $this->getComps();
        $disciplines = $this->getDisc();
        $groups = $this->getGroups();
        $users = $this->getUsers();
        $ranks = $this->getRanks();
        $genders = $this->GetGenders();
        $results = $this->getResults();
        $ages = $this->getAges();
        
       
        $id = $request->input('user_id');
        
        
        
        $res = Result::where('user_id', '=', $id)->get();

        $this->content = view(env('THEME').'.results_content')->with(['res'=>$res, 'results'=>$results, 'competitions'=> $competitions, 'disciplines'=>$disciplines, 'groups'=>$groups, 'users'=>$users, 'ranks'=>$ranks, 'genders'=>$genders, 'ages'=>$ages])->render();
        
        if($this->content){
              $this->vars = array_add($this->vars,'content', $this->content);
              }
        
        return $this->renderOutPut();
       
    }
    
    
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $competitions = \App\Competition::where('status','1')->get()->reduce(function($returnComps, $competition){
            $returnComps[$competition->id] = $competition->title;
                        //dd($returnComps);
            return $returnComps;;
        },[]);
        
        $judges = $this->getJudges()->reduce(function($returnJudges, $judge){
            $returnJudges[$judge->id] = $judge->name;
            return $returnJudges;
        },[]);
        
        $users = $this->getUsers()->reduce(function($returnUsers, $user){
            $returnUsers[$user->id] = $user->name;
            return $returnUsers;
        },[]);
        
        $disciplines = $this->getDisc()->reduce(function($returnDisciplines, $discipline){
            $returnDisciplines[$discipline->id] = $discipline->name;
            return $returnDisciplines;
        },[]);
        
        $groups = $this->getGroups()->reduce(function($returnGroups, $group){
            $returnGroups[$group->id] = $group->name;
            return $returnGroups;
        },[]);
        
        $ranks = $this->getRanks()->reduce(function($returnRanks, $rank){
            $returnRanks[$rank->id] = $rank->name;
            return $returnRanks;
        },[]);
        
        $genders = $this->getGenders()->reduce(function($returnGenders, $gender){
            $returnGenders[$gender->id] = $gender->name;
            return $returnGenders;
        },[]);
        
        $ages = $this->getAges()->reduce(function($returnAges, $age){
            $returnAges[$age->id] = $age->choices;
            return $returnAges;
        },[]);
                
        $this->content = view(env('THEME').'.result_create_content')->with(['judges'=>$judges, 'competitions'=>$competitions, 'disciplines'=>$disciplines, 'groups'=>$groups, 'genders'=>$genders, 'ages'=>$ages, 'ranks'=>$ranks, 'users'=>$users])->render();
        
        if($this->content){
              $this->vars = array_add($this->vars,'content', $this->content);
              }
        
        return $this->renderOutPut();
    }
    
    public function getRoles(){
        return \App\Role::all();
    }
    
    public function getJudges(){
        return \App\Judge::all();
    }
    
    public function getTeams(){
        return \App\Team::all();
    }
    
    
    public function getUsers(){
        return \App\User::all();
    }
    
    public function getRanks(){
        return \App\Rank::all();
    }
    
    public function getGenders(){
        return \App\Gender::all();
    }
    
    public function getAges(){
        return \App\Age::all();
    }
    
    public function getComps(){
        return \App\Competition::all();
    }
    
    public function getDisc(){
        return \App\Discipline::all();
    }
    
    public function getGroups(){
        return \App\Group::all();
    }
    
    public function getResults(){
        return \App\Result::all();
    }
    
   
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = $this->re_rep->addResult($request);
        if(is_array($res) && !empty($res['error'])){
            return back()->with($res);
        }
        if(\Auth::user()->hasRole('Admin')){
        return redirect('/admin')->with($res);
        }else {
            return redirect('/')->with($res);
        }
        
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {

        
        $competitions = $this->getComps()->reduce(function($returnCompetitions, $competition){
            $returnCompetitions[$competition->id] = $competition->title;
            return $returnCompetitions;
        },[]);
        
        $judges = $this->getJudges()->reduce(function($returnJudges, $judge){
            $returnJudges[$judge->id] = $judge->name;
            return $returnJudges;
        },[]);
        
        $users = $this->getUsers()->reduce(function($returnUsers, $user){
            $returnUsers[$user->id] = $user->name;
            return $returnUsers;
        },[]);
        
        $disciplines = $this->getDisc()->reduce(function($returnDisciplines, $discipline){
            $returnDisciplines[$discipline->id] = $discipline->name;
            return $returnDisciplines;
        },[]);
        
        $groups = $this->getGroups()->reduce(function($returnGroups, $group){
            $returnGroups[$group->id] = $group->name;
            return $returnGroups;
        },[]);
        
        $ranks = $this->getRanks()->reduce(function($returnRanks, $rank){
            $returnRanks[$rank->id] = $rank->name;
            return $returnRanks;
        },[]);
        
        $genders = $this->getGenders()->reduce(function($returnGenders, $gender){
            $returnGenders[$gender->id] = $gender->name;
            return $returnGenders;
        },[]);
        
        $ages = $this->getAges()->reduce(function($returnAges, $age){
            $returnAges[$age->id] = $age->choices;
            return $returnAges;
        },[]);
        
        
        $this->content = view(env('THEME').'.result_create_content')->with(['judges'=>$judges, 'result'=>$result,'competitions'=>$competitions, 'groups'=>$groups, 'disciplines'=>$disciplines, 'genders'=>$genders, 'ages'=>$ages, 'ranks'=>$ranks, 'users'=>$users])->render();
        
        if($this->content){
              $this->vars = array_add($this->vars,'content', $this->content);
              }
        
        return $this->renderOutPut();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $result)
    {
        $res = $this->re_rep->updateResult($request, $result);
        if(is_array($res) && !empty($res['error'])){
            return back()->with($res);
             }
        if(\Auth::user()->hasRole('Admin')){
        return back()->with($res);
        }else {
            return redirect('/signup')->with($res);
       
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
       $res = $this->re_rep->deleteResult($result);
       
      if(\Auth::user()->hasRole('Admin')){
        return redirect('/admin')->with($res);
        }else {
            return redirect('/signup')->with($res);
        }
    }
}
