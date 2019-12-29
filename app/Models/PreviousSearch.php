<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreviousSearch extends Model
{
    protected $fillable = [ 'word', 'definition', 'part_of_speech', 'hits' ];
}
