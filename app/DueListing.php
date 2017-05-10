<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DueListing extends Model
{
    /**
     *Table associated with this model
     * @var string
     */
    protected $table = 'tbl_due_listings';

    /**
     *Mass assignable fields
     * @var array
     */
    protected $fillable = ['profile_id', 'amount', 'date_credited'];

    /**
     *Get the customer who owns the debt
     */
    public function customer()
    {
        return $this->belongsTo('App\Profile');
    }
}
