<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $table = 'threads';
    protected $primaryKey = 'thread_id';

    protected $fillable = [
        'user_id',
        'titel',
        'beschrijving',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class, 'thread_id', 'thread_id');
    }
}
