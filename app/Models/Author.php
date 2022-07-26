<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];
    protected $appends = ['full_name'];
    protected $fillable = ['first_name', 'last_name'];

    public function getFullNameAttribute(){
        return $this->attributes['first_name'] . " " . $this->attributes['last_name'];
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
