<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tip;
use App\Category;
use App\Http\Requests\TipRequest;

use Parsedown;

class TipController extends Controller
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
        $tips = Tip::paginate();
        return view('tips.index')->with('tips', $tips);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('tips.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(TipRequest $request)
    {

        // Create the Tip object
        $tip = new Tip;
        $tip->user_id      = \Auth::user()->id;
        $tip->name         = $request->get('name');
        $tip->oneline      = $request->get('oneline');
        $tip->description  = $request->get('description');

        // Save the tip
        $tip->save();

        // Assign the categories
        $categories = explode(',', $request->categories); 
        $tip->categories()->sync(array_slice($categories, 0, 3));

        // If the user has submitted the minimum number of
        // approved tips, automatically approve the tip.
        if (\Auth::user()->tips()->count() > env('TIPS_APPROVED_MINIMUM')) {

            $tip->approved = date('Y-m-d G:i:s');
            $tip->save();
            $message = 'Tip submitted and approved!';

        // The user has not yet met the approval threshold,
        // so e-mail the tip to LaraBrain support for approval.
        } else {

            \Mail::send('emails.approval', ['tip' => $tip], function ($m) {
                $m->to(env('MAIL_TO'), env('MAIL_NAME'))
                    ->subject('Tip submitted for approval');
            });

            $message = 'Tip submitted for approval!';

        }

        // Redirect the user to the tip
        return \Redirect::route('tips.show', 
            array($tip->slug))->with('message', $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $tip = Tip::withUnapproved()->where('slug', $id)->first();

        $parsedown = new Parsedown();

        $tip->description = $parsedown->text($tip->description);

        $allowedTags = '<p><br><pre><code><i><a>';

        $tip->description = strip_tags($tip->description, $allowedTags);

        return view('tips.show')->withTip($tip);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $tip = Tip::withUnapproved()->find($id);

        if (Tip::isEditable($tip->id))
        {

            $categories = Category::orderBy('name', 'asc')->get();
            return view('tips.edit')
                ->withTip($tip)
                ->withCategories($categories);

        }

        return \Redirect::route('tips.index')
            ->with('message', 'You do not have permission to edit this tip.');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(TipRequest $request, $id)
    {

        $tip = Tip::withUnapproved()->find($id);

        $tip->name = $request->get('name');
        $tip->oneline = $request->get('oneline');
        $tip->description = $request->get('description');

        $categories = explode(",", $request->categories);
 
        $tip->categories()->sync(array_slice($categories, 0, 3));

        if ($tip->save())
        {

            $message = 'The tip has been successfully updated.';

        } else {

            $message = 'Unable to edit this tip.';
        
        }

        // Redirect the user to the tip
        return \Redirect::route('tips.show', 
            array($tip->slug))->with('message', $message);
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
     * Retrieve the latest tips
     * @return [type] [description]
     */
    public function latest()
    {
        $tips = Tip::orderBy('created_at', 'desc')->paginate(20);
        
        return view('tips.latest')
            ->withTips($tips); 
    }

    /**
     * Retrieve the most starred tips
     * @return [type] [description]
     */
    public function popular()
    {
        $tips = Tip::starred()->paginate();
        return view('tips.popular')
            ->withTips($tips); 
    }

    /**
     * Search the tip database
     * @return [type] [description]
     */
    public function search(Request $request)
    {
        \Debugbar::info($request->get('keywords'));
        $tips = Tip::search('name', $request->get('keywords'))->paginate();
        return view('tips.search')->withTips($tips);
    }

    /**
     * Toggle user-initiated starring of a tip
     * @return string JSON response
     */
    public function star(Request $request)
    {

        $outcome = '';
        $result = false;

        if (\Auth::user()) 
        {
            
            $tip = Tip::find($request->id);

            $user = \Auth::user();

            if ($user->stars->contains($tip->id))
            {
                $outcome = 'starred';
                $user->stars()->detach($tip);
                $tip->star_count--;
                $tip->save();
            } else {
                $outcome = 'unstarred';
                $user->stars()->attach($tip->id);
                $tip->star_count++;
                $tip->save();
            }

            $result = true;

        }

        return response()->json(
            ['result' => $result, 'outcome' => $outcome]
        );
    
    }

}
