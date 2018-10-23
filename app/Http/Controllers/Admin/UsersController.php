<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;

use App\Repositories\AdminUsersRepository;

use App\Repositories\RolesRepository;

use App\Repositories\RanksRepository;

use App\Repositories\GendersRepository;

use App\Repositories\AdminAgesRepository;

use App\User;

use App\Rank;

use App\Gender;

use App\Age;

use Gate;

class UsersController extends AdminController
{
    
    protected $us_rep;
    protected $rol_rep;
    protected $ra_rep;
    protected $g_rep;
    protected $ag_rep;
    
    public function __construct(RolesRepository $rol_rep, AdminUsersRepository $us_rep, RanksRepository $ra_rep, GendersRepository $g_rep, AdminAgesRepository $ag_rep){
        parent::__construct();
        
        if (Gate::denies('EDIT_USERS')) {
            abort(403);
        }
        
        $this->rol_rep = $rol_rep;
        $this->us_rep = $us_rep;
        $this->ra_rep = $ra_rep;
        $this->g_rep = $g_rep;
        $this->ag_rep = $ag_rep;
        
        $this->template = env('THEME').'.admin.users';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->us_rep->getu();
        
        $ranks = $this->ra_rep->getra();
        
        $genders = $this->g_rep->getg();
        
        $ages = $this->ag_rep->getag();
        
        $this->content = view(env('THEME').'.admin.users_content')->with(['users'=>$users, 'ranks'=>$ranks, 'genders'=>$genders, 'ages'=>$ages])->render();
        
        return $this->renderOutPut();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->getRoles()->reduce(function($returnRoles, $role){
            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
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
        $this->content = view(env('THEME').'.admin.user_create_content')->with(['roles'=>$roles,'ranks'=>$ranks, 'genders'=>$genders, 'ages'=>$ages])->render();
        
        return $this->renderOutPut();
    
    }
    
    public function getRoles(){
        return \App\Role::all();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->us_rep->addUser($request);
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
    public function edit(User $user)
    {
         $roles = $this->getRoles()->reduce(function($returnRoles, $role){
            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
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
       
        $this->content = view(env('THEME').'.admin.user_create_content')->with(['roles'=>$roles,'user'=>$user, 'ranks'=>$ranks, 'genders'=>$genders, 'ages'=>$ages])->render();
        
        return $this->renderOutPut();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $result = $this->us_rep->updateUser($request, $user);
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
    public function destroy(User $user)
    {
        $result = $this->us_rep->deleteUser($user);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }   
}
