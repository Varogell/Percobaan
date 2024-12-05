<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stimulus extends Model
{
    use HasFactory;
    protected $table = 'stimulus';

    protected $fillable = ['title', 'path', 'is_published'];
}
