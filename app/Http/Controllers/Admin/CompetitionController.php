<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\CompetitionRequest;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Repositories\CompRepository;
use App\Repositories\AdminDisciplineRepository;
use App\Repositories\AdminGroupsRepository;
use App\Repositories\AdminUsersRepository;
use App\Repositories\RanksRepository;
use App\Repositories\GendersRepository;
use App\Repositories\AdminAgesRepository;
use App\Repositories\ResultRepository;

use App\Competition;

use Gate;


class CompetitionController extends AdminController
{
    
    protected $c_rep;
    protected $d_rep;
    protected $gr_rep;
    protected $us_rep;
    protected $ra_rep;
    protected $g_rep;
    protected $re_rep;
    protected $ag_rep;

    
    public function __construct(ResultRepository $re_rep, AdminUsersRepository $us_rep, CompRepository $c_rep,AdminDisciplineRepository $d_rep, AdminGroupsRepository $gr_rep, RanksRepository $ra_rep, GendersRepository $g_rep, AdminAgesRepository $ag_rep){
        parent::__construct();
        
        if (Gate::denies('EDIT_COMPETITIONS')) {
            abort(403);
        }
        
        $this->c_rep = $c_rep;
        $this->d_rep = $d_rep;
        $this->gr_rep = $gr_rep;
        $this->us_rep = $us_rep;
        $this->ra_rep = $ra_rep;
        $this->g_rep = $g_rep;
        $this->ag_rep = $ag_rep;
        $this->re_rep = $re_rep;

        
        $this->template = env('THEME').'.admin.competitions';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitions = $this->c_rep->getc();

        $this->content = view(env('THEME').'.admin.competitions_content')->with(['competitions'=> $competitions])->render();
        
        return $this->renderOutPut();
    }
    /**public function search(Request $request){
    
    if($request->search != ''){
           
           $result = $result->where('user_id', 'like', $request->search)->get();
       }
    }**/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Gate::denies('create', new \App\Competition)){
            abort(403);
            
        }
        
        /**$user = $request->input('user');
        
        $result = Result::with('users', function($query) use ($user) {
         $query->where('user_id', 'LIKE', '%' . $user . '%');
    })->get();**/
        
       
        
        $this->content = view(env('THEME').'.admin.competition_create_content')->render();
        
        return $this->renderOutPut();
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->c_rep->addCompetition($request);
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
    public function edit(Competition $competition, Request $request){
            
        $disciplines = $this->d_rep->getd();
        $groups = $this->gr_rep->getgr();
        $users = $this->us_rep->getu();
        $ranks = $this->ra_rep->getra();
        $genders = $this->g_rep->getg();
        $ages = $this->ag_rep->getag();
        //$results = \App\Result::orderBy('group_id')->orderBy('final_score','desc')->orderBy('discipline_id')->get(); 
        $results = $this->re_rep->getre('*',FALSE, TRUE);
        
        $count = FALSE;
        
        if($results){
        foreach($results as $result){
            $count = count($result);
        }   
        }
        
        $id = $request->input('user_id');
        $res = \App\Result::where('user_id', '=', $id)->get();
        
        $pattern = $result->discipline->name;
    
        $this->content = view(env('THEME').'.admin.competition_create_content')->with(['pattern'=>$pattern, 'res'=>$res, 'count'=>$count, 'results'=>$results, 'competition'=> $competition, 'disciplines'=>$disciplines, 'groups'=>$groups, 'users'=>$users, 'ranks'=>$ranks, 'genders'=>$genders, 'ages'=>$ages])->render();
        
        return $this->renderOutPut();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $competition)
    {
        $result = $this->c_rep->updateCompetition($request, $competition);
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
    public function destroy(Competition $competition)
    {
        $result = $this->c_rep->deleteCompetition($competition);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    
    }
}
