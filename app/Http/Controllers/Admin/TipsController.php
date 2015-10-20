<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tip;

class TipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tips = Tip::withUnapproved()
            ->orderBy('created_at', 'desc')
            ->orderBy('approved', NULL)
            ->paginate();

        return view('admin.tips.index')
            ->withTips($tips);
    }

    /**
     * Approve submitted tip
     * @param  integer $id Primary key of tip
     * @return [type]     [description]
     */
    public function approve($id)
    {
        $tip = Tip::withUnapproved()->find($id);

        $tip->approved = date('Y-m-d G:i:s');

        $tip->save();

        return \Redirect::route('admin.tips.index')->with('Tip approved');

    }

    /**
     * Unapprove submitted tip
     * @param  integer $id Primary key of tip
     * @return [type]     [description]
     */
    public function unapprove($id)
    {
        
        $tip = Tip::find($id);

        $tip->approved = NULL;

        $tip->save();

        return \Redirect::route('admin.tips.index')->with('Tip unapproved');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
