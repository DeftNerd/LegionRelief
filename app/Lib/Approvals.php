<?php

namespace App\Lib;

trait Approvals
{

    /**
     * Boot the approval trait for a model.
     *
     * @return void
     */
    public static function bootApprovals()
    {
        static::addGlobalScope(new ApprovedScope);
    }

    /**
     * Determine if the model instance has been soft-deleted.
     *
     * @return bool
     */
    public function approved()
    {
        return ! is_null($this->{$this->getApprovedColumn()});
    }

    /**
     * Get a new query builder that includes soft deletes.
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public static function withUnapproved()
    {
        return (new static)->newQueryWithoutScope(new ApprovedScope);
    }

    /**
     * Get a new query builder that only includes soft deletes.
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public static function onlyUnapproved()
    {
        $instance = new static;

        $column = $instance->getQualifiedApprovedColumn();

        return $instance->newQueryWithoutScope(new ApprovedScope)->whereNull($column);
    }

    /**
     * Get the name of the "approved" column.
     *
     * @return string
     */
    public function getApprovedColumn()
    {
        return defined('static::APPROVED') ? static::APPROVED : 'approved';
    }

    /**
     * Get the fully qualified "approved" column.
     *
     * @return string
     */
    public function getQualifiedApprovedColumn()
    {
        return $this->getTable().'.'.$this->getApprovedColumn();
    }
}
