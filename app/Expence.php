<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Expence
 * @packege App
 * 
 * @property int id
 * @property string title
 * @property int author_id
 * @property int summ
 * @property string slug
 * @property string body
 * @property string date
 * @property string comment
 */

class Expence extends Model
{
    protected $table = 'expences';

    public function author() {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
