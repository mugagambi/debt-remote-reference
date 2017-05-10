<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
    *The table associated with this model
     *@var string
     */
    protected $table = 'tbl_profiles';

    /**
    *Fields that are mass assignable in the database
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'national_id'];
    /**
    *Get debts for the customer
     */
    public function due_listings()
    {
        return $this->hasMany('App\DueListing');
    }
}
