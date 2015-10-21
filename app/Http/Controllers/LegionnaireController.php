<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Legionnaire;
use App\Category;
use App\Http\Requests\LegionnaireRequest;

use Parsedown;

class LegionnaireController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', 
            ['only' => ['create', 'store', 'edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $legionnaires = Legionnaire::paginate();
        return view('legionnaires.index')->with('legionnaires', $legionnaires);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('legionnaires.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(LegionnaireRequest $request)
    {

        // Create the Legionnaire object
        $legionnaire = new Legionnaire;
        $legionnaire->user_id      = \Auth::user()->id;
        $legionnaire->name         = $request->get('name');
	$legionnaire->handle	   = $request->get('handle');
        $legionnaire->oneline      = $request->get('oneline');
	$legionnaire->address	   = $request->get('address');
	$legionnaire->contact	   = $request->get('contact');
	$legionnaire->charges	   = $request->get('charges');
	$legionnaire->sentences	   = $request->get('sentences');
        $legionnaire->description  = $request->get('description');
	$legionnaire->status	   = $request->get('status');

        // Save the legionnaire
        $legionnaire->save();

        // Assign the categories
        $categories = explode(',', $request->categories); 
        $legionnaire->categories()->sync(array_slice($categories, 0, 3));

        // If the user has submitted the minimum number of
        // approved legionnaires, automatically approve the legionnaire.
        if (\Auth::user()->legionnaires()->count() > env('LEGIONAIRES_APPROVED_MINIMUM')) {

            $legionnaire->approved = date('Y-m-d G:i:s');
            $legionnaire->save();
            $message = 'Legionnaire submitted and approved!';

        // The user has not yet met the approval threshold,
        // so e-mail the legionnaire to LegionRelief support for approval.
        } else {

            \Mail::send('emails.approval', ['legionnaire' => $legionnaire], function ($m) {
                $m->to(env('MAIL_TO'), env('MAIL_NAME'))
                    ->subject('Legionnaire submitted for approval');
            });

            $message = 'Legionnaire submitted for approval!';

        }

        // Redirect the user to the legionnaire
        return \Redirect::route('legionnaires.show', 
            array($legionnaire->slug))->with('message', $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $legionnaire = Legionnaire::withUnapproved()->where('slug', $id)->first();

        $parsedown = new Parsedown();

        $legionnaire->description = $parsedown->text($legionnaire->description);

        $allowedTags = '<p><br><pre><code><i><a>';

        $legionnaire->description = strip_tags($legionnaire->description, $allowedTags);

        return view('legionnaires.show')->withLegionnaire($legionnaire);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $legionnaire = Legionnaire::withUnapproved()->find($id);

        if (Legionnaire::isEditable($legionnaire->id))
        {

            $categories = Category::orderBy('name', 'asc')->get();
            return view('legionnaires.edit')
                ->withLegionnaire($legionnaire)
                ->withCategories($categories);

        }

        return \Redirect::route('legionnaires.index')
            ->with('message', 'You do not have permission to edit this legionnaire.');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(LegionnaireRequest $request, $id)
    {

        $legionnaire = Legionnaire::withUnapproved()->find($id);

        $legionnaire->name = $request->get('name');
        $legionnaire->oneline = $request->get('oneline');
        $legionnaire->description = $request->get('description');

        $categories = explode(",", $request->categories);
 
        $legionnaire->categories()->sync(array_slice($categories, 0, 3));

        if ($legionnaire->save())
        {

            $message = 'The legionnaire has been successfully updated.';

        } else {

            $message = 'Unable to edit this legionnaire.';
        
        }

        // Redirect the user to the legionnaire
        return \Redirect::route('legionnaires.show', 
            array($legionnaire->slug))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Retrieve the latest legionnairess
     * @return [type] [description]
     */
    public function latest()
    {
        $legionnaires = Legionnaire::orderBy('created_at', 'desc')->paginate(20);
        
        return view('legionnaires.latest')
            ->withLegionnaires($legionnaires); 
    }

    /**
     * Retrieve the most starred legionnaires
     * @return [type] [description]
     */
    public function popular()
    {
        $legionnaires = Legionnaire::starred()->paginate();
        return view('legionnaires.popular')
            ->withLegionnaires($legionnaires); 
    }

    /**
     * Search the legionnaire database
     * @return [type] [description]
     */
    public function search(Request $request)
    {
        \Debugbar::info($request->get('keywords'));
        $legionnaires = Legionnaire::search('name', $request->get('keywords'))->paginate();
        return view('legionnaires.search')->withLegionnaires($legionnaires);
    }

    /**
     * Toggle user-initiated starring of a legionnaire
     * @return string JSON response
     */
    public function star(Request $request)
    {

        $outcome = '';
        $result = false;

        if (\Auth::user()) 
        {
            
            $legionnaire = Legionnaire::find($request->id);

            $user = \Auth::user();

            if ($user->stars->contains($legionnaire->id))
            {
                $outcome = 'starred';
                $user->stars()->detach($legionnaire);
                $legionnaire->star_count--;
                $legionnaire->save();
            } else {
                $outcome = 'unstarred';
                $user->stars()->attach($legionnaire->id);
                $legionnaire->star_count++;
                $legionnaire->save();
            }

            $result = true;

        }

        return response()->json(
            ['result' => $result, 'outcome' => $outcome]
        );
    
    }

}
