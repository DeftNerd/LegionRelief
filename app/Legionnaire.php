<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

use Illuminate\Database\Eloquent\Model;

use App\Lib\Approvals;

class Legionnaire extends Model implements SluggableInterface
{

	use SluggableTrait, Approvals;

    /**
     * [$sluggable description]
     * @var [type]
     */
    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug'
    ];

    // What attributes are mass-assignable?
    protected $fillable = ['name', 'handle', 'oneline', 'address', 'contact', 'charged_at', 'charges', 'sentenced_at', 'sentences', 'released_at', 'paroled_at', 'description', 'status'];

    /**
     * Each legionnaire has a creator
     * @return User The creator's User object
     */
    public function creator()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Each legionnaire belongs to one or more categories
     * @return Collection Collection of Category objects
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * A legionnaire can be starred by multiple users.
     * @return Collection Collection of User objects
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'legionnaire_user');
    }

    /**
     * Override the default created_at formatting
     * @param  string $date The object's created_at value
     * @return string       A modified timestamp format
     */
    public function getCreatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)
            ->format('F j, Y g:i a');
    }

    /**
     * Retrieve only approved legionnaires
     * @param  [type] $query [description]
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    /**
     * Retrieve legionnaires in order of star frequency
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStarred($query)
    {

        return $query
        ->where('star_count', '>', 0)
        ->orderBy('star_count', 'desc');

    }

    /**
     * Search the legionnaires table 
     * @param  Object $query The $query object
     * @param  String $field The searchable field
     * @param  String $value The thing we're looking for
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $field, $value)
    {

        if (in_array($field, ['name', 'oneline', 'description'])) {

            return $query->where($field, 'LIKE', "%$value%");

        }

        return false;

    }

    /**
     * Determines whether user has adequate permissions to edit legionnaire.
     * @return Boolean
     */
    public static function isEditable($id)
    {

        if (\Auth::check()) {
        if (\Auth::User()->isAdmin() || \Auth::User()->owns($id))
            return true;
        }

        return false;

    }

    /**
     * Determines whether the legionnaire has been approved
     * @return boolean true if approved, false if not
     */
    public function isApproved()
    {

        return $this->approved();

    }

}
