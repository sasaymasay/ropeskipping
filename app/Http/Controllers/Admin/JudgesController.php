<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\JudgeRequest;

use App\Repositories\AdminJudgesRepository;

use App\Judge;

use Gate;

class JudgesController extends AdminController
{
    protected $j_rep;
    
    public function __construct(AdminJudgesRepository $j_rep){
        parent::__construct();
        
       if (Gate::denies('EDIT_JUDGES')) {
            abort(403);
        }
        $this->j_rep = $j_rep;
       
        
        $this->template = env('THEME').'.admin.judges';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judges = $this->j_rep->getj();
        
        
        $this->content = view(env('THEME').'.admin.judges_content')->with('judges', $judges)->render();
        
        return $this->renderOutPut();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $this->content = view(env('THEME').'.admin.judge_create_content')->render();
        
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
        $result = $this->j_rep->addJudge($request);
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
    public function edit(Judge $judge)
    {
         $this->content = view(env('THEME').'.admin.judge_create_content')->with('judge',$judge)->render();
        
        return $this->renderOutPut();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $judge)
    {
        $result = $this->j_rep->updateJudge($request, $judge);
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
    public function destroy(Judge $judge)
    {
        $result = $this->j_rep->deleteJudge($judge);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }
}
