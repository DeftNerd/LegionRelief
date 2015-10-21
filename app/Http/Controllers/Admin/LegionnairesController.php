<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Legionnaire;

class LegionnairesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $legionnaires = Legionnaire::withUnapproved()
            ->orderBy('created_at', 'desc')
            ->orderBy('approved', NULL)
            ->paginate();

        return view('admin.legionnaires.index')
            ->withLegionnaires($legionnaires);
    }

    /**
     * Approve submitted legionnaire
     * @param  integer $id Primary key of legionnaire
     * @return [type]     [description]
     */
    public function approve($id)
    {
        $legionnaire = Legionnaire::withUnapproved()->find($id);

        $legionnaire->approved = date('Y-m-d G:i:s');

        $legionnaire->save();

        return \Redirect::route('admin.legionnaires.index')->with('Legionnaire approved');

    }

    /**
     * Unapprove submitted legionnaire
     * @param  integer $id Primary key of legionnaire
     * @return [type]     [description]
     */
    public function unapprove($id)
    {
        
        $legionnaire = Legionnaire::find($id);

        $legionnaire->approved = NULL;

        $legionnaire->save();

        return \Redirect::route('admin.legionnaires.index')->with('Legionnaire unapproved');

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
