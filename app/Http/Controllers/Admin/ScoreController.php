<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Score;
use App\Result;
use App\Freescore;

use DB;

use App\Repositories\CompRepository;
use App\Repositories\AdminDisciplineRepository;
use App\Repositories\AdminGroupsRepository;
use App\Repositories\AdminUsersRepository;
use App\Repositories\RanksRepository;
use App\Repositories\GendersRepository;
use App\Repositories\AdminAgesRepository;
use App\Repositories\AdminJudgesRepository;
use App\Repositories\ScoreRepository;








class ScoreController extends AdminController
{
    protected $c_rep;
    protected $d_rep;
    protected $gr_rep;
    protected $us_rep;
    protected $ra_rep;
    protected $g_rep;
    protected $re_rep;
    protected $ag_rep;
    protected $sc_rep;
    protected $j_rep;

 
    
    
     public function __construct(AdminJudgesRepository $j_rep, ScoreRepository $sc_rep, AdminUsersRepository $us_rep, CompRepository $c_rep,AdminDisciplineRepository $d_rep, AdminGroupsRepository $gr_rep, RanksRepository $ra_rep, GendersRepository $g_rep, AdminAgesRepository $ag_rep) {
        
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
       // $this->re_rep = $re_rep;
        $this->sc_rep = $sc_rep;
        $this->j_rep = $j_rep;


        $this->template= env('THEME').'.admin.scores';
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
        $scores = $this->getScores();
        
         
        
        $this->content = view(env('THEME').'.admin.score_content')->with(['scores'=>$scores, 'results'=>$results, 'competitions'=> $competitions, 'disciplines'=>$disciplines, 'groups'=>$groups, 'users'=>$users, 'ranks'=>$ranks, 'genders'=>$genders, 'ages'=>$ages])->render();
        
        
        return $this->renderOutPut();
       
    }
    
    
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Score $score, Result $result)
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
        
        $use = $result->user_id;
        
        $disc = $result->discipline_id;
        
        $grp = $result->group_id;
        
        $rnk = $result->rank_id;
        
        $comps = $result->competition_id;
        


       // $final_score = \App\Score::where(['user_id'=>$use, 'discipline_id'=>$disc])->avg('score_j1', 'score_j2');
        
        //$count_score = \App\Score::where(['user_id'=>$use, 'discipline_id'=>$disc])->count('score');
        
        //$final_fscore = \App\Freescore::where(['user_id'=>$use, 'discipline_id'=>$disc])->avg('');
        
       // DB::table('results')->where(['user_id'=>$use, 'discipline_id'=>$disc, 'group_id'=>$grp, 'rank_id'=>$rnk])->update(array('final_score'=>$final_score));
        
        //$pattern = '/Фристайл/*';
        
        //$pattern = (preg_match('/Фристайл/',$result->discipline->name));
       /* $final_score = \App\Score::where(['user_id'=>$use, 'discipline_id'=>$disc,'competition_id'=>$comps, 'group_id'=>$grp])->avg('score_j1', 'score_j2');
                
        DB::table('results')->where(['user_id'=>$use, 'discipline_id'=>$disc, 'group_id'=>$grp, 'rank_id'=>$rnk, 'competition_id'=>$comps, 'group_id'=>$grp])->update(array('final_score'=>$final_score));*/

        
        $this->content = view(env('THEME').'.admin.score_create_content')->with(['comps'=>$comps, 'grp'=>$grp, 'judges'=>$judges, 'result'=>$result,'competitions'=>$competitions, 'groups'=>$groups, 'disciplines'=>$disciplines,'disc'=>$disc, 'genders'=>$genders, 'ages'=>$ages, 'ranks'=>$ranks, 'users'=>$users, 'use'=>$use])->render();
        
        
        
        return $this->renderOutPut();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request, Score $score)
    {
        $res = $this->sc_rep->addScore($request, $score);
        
        if(is_array($res) && !empty($res['error'])){
            return back()->with($res);
        }
        if(\Auth::user()->hasRole('Admin')){
        return back()->with($res);
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
    public function edit(Freescore $freescore, Result $result, Score $score)
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
        
        $use = $result->user_id;
        
        $disc = $result->discipline_id;
        
        $grp = $result->group_id;
        
        $rnk = $result->rank_id;
        
        $comps = $result->competition_id;
        
        
        
        
        
        $pattern = (preg_match('/Фристайл/',$result->discipline->name));
        
        if($pattern){
            
            $freescore = \App\Freescore::where(['user_id'=>$use, 'discipline_id'=>$disc,'competition_id'=>$comps, 'group_id'=>$grp])->first();
            
            if (isset($freescore)){
            
            
            $resf1 = ($freescore->sloz1 + $freescore->sloz2 + $freescore->sloz3)/3;
            $resf2 = ($freescore->plot1 + $freescore->plot2 + $freescore->plot3)/3;
            $resf3 = ($freescore->tech1 + $freescore->tech2 + $freescore->tech3)/3;
            $resf4 = ($freescore->zrel1 + $freescore->zrel2 + $freescore->zrel3)/3;
            
            $resf = $resf1 + $resf2 + $resf3 + $resf4;
            
            $resfs = $resf - $freescore->major_judge;

            DB::table('results')->where(['user_id'=>$use, 'discipline_id'=>$disc, 'group_id'=>$grp, 'rank_id'=>$rnk])->update(array('final_score'=>$resfs));
   
        }
        } else {
            
                $score = \App\Score::where(['user_id'=>$use, 'discipline_id'=>$disc, 'competition_id'=>$comps, 'group_id'=>$grp])->first();
                
                if (isset($score)){
                
                $ress = ($score->score_j1 + $score->score_j2)/2;
                
                $resss = $ress - $score->major_judge;
                
                
                DB::table('results')->where(['user_id'=>$use, 'discipline_id'=>$disc, 'group_id'=>$grp, 'rank_id'=>$rnk, 'competition_id'=>$comps,])->update(array('final_score'=>$resss));
            }
        }

        
      

        
        $this->content = view(env('THEME').'.admin.score_create_content')->with(['pattern'=>$pattern,/** 'count_score'=>$count_score, 'final_score'=>$final_score, **/'judges'=>$judges, 'result'=>$result, 'competitions'=>$competitions, 'groups'=>$groups, 'disciplines'=>$disciplines,'disc'=>$disc, 'genders'=>$genders, 'ages'=>$ages, 'ranks'=>$ranks, 'users'=>$users, 'use'=>$use, 'comps'=>$comps, 'grp'=>$grp])->render();
        
        
        
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
    
    public function getScores(){
        return \App\Score::all();
    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Freescore $freescore)
    {

        $res = $this->sc_rep->updateScore($request, $freescore);  
        
            
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
       $res = $this->sc_rep->deleteResult($result);
       
      if(\Auth::user()->hasRole('Admin')){
        return redirect('/admin')->with($res);
        }else {
            return redirect('/signup')->with($res);
        }
    }
}
