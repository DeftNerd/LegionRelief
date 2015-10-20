<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tip;

class Category extends Model
{

	/**
	 * Each category can belong to many tips
	 * @return tips
	 */
    public function tips()
    {
        return $this->belongsToMany('App\Tip')->orderBy('created_at', 'desc');
    }

    /**
     * Retrieve the latest tips associated with a category
     * @return [type] [description]
     */
    public function latestTip()
    {
    	return $this->tips()->orderBy('created_at', 'desc')->take(1)->first();
    }

    /** 
     * Retrieve a list of recently updated categories
     *
     */
    static function active($count = 5)
    {
        return Category::whereHas('Tips', function($q) {
            $q
            ->groupBy('category_id')
            ->orderBy('tips.created_at', 'desc');
        })->take($count)->get();
    }

}
