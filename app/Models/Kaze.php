<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaze extends Model
{
    use HasFactory;
    // 以下を追記
    protected $table = 'kaze';
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
}
