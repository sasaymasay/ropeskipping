<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\AdminGroupsRepository;

use App\Group;

use Gate;

class GroupsController extends AdminController
{
    
    protected $gr_rep;

    
    public function __construct(AdminGroupsRepository $gr_rep){
        parent::__construct();
        
        if (Gate::denies('EDIT_GROUPS')) {
            abort(403);
        }
        

        $this->gr_rep = $gr_rep;
        
        $this->template = env('THEME').'.admin.groups';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $groups = $this->gr_rep->getgr();
        
        $this->content = view(env('THEME').'.admin.groups_content')->with('groups', $groups)->render();
        
        return $this->renderOutPut();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create', new \App\Group)){
            abort(403);
            
        }
        
        
        $this->content = view(env('THEME').'.admin.group_create_content')->render();
        
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
        $result = $this->gr_rep->addGroup($request);
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
    public function edit(Group $group)
    {
         $this->content = view(env('THEME').'.admin.group_create_content')->with('group',$group)->render();
        
        return $this->renderOutPut();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $group)
    {
        $result = $this->gr_rep->updateGroup($request, $group);
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
    public function destroy(Group $group)
    {
        $result = $this->gr_rep->deleteGroup($group);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }
}
