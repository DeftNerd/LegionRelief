<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Legionnaire;

class Category extends Model
{

	/**
	 * Each category can belong to many legionnaires
	 * @return legionnaires
	 */
    public function legionnaires()
    {
        return $this->belongsToMany('App\Legionnaire')->orderBy('created_at', 'desc');
    }

    /**
     * Retrieve the latest legionnaires associated with a category
     * @return [type] [description]
     */
    public function latestLegionnaire()
    {
    	return $this->legionnaires()->orderBy('created_at', 'desc')->take(1)->first();
    }

    /** 
     * Retrieve a list of recently updated categories
     *
     */
    static function active($count = 5)
    {
        return Category::whereHas('Legionnaires', function($q) {
            $q
            ->groupBy('category_id')
            ->orderBy('legionnaires.created_at', 'desc');
        })->take($count)->get();
    }

}
