<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageQueue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'package_id',
        'data',
    ];

    /**
     * Table name
     * 
     * @var string
     */
    protected $table = "package_history";

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
