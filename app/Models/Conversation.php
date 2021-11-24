<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'contact_id', 'has_blocked', 'last_message', 'last_time', 'listen_notifications'];

    protected $appends = ['contact_name', 'contact_image'];

    public function getContactNameAttribute()
    {
        return $this->contact()->first(['name'])->name;
    }

    public function getContactImageAttribute()
    {
        return "/users/". $this->contact()->first(['image'])->image;
    }

    public function contact()
    {
        return $this->belongsTo(User::class, 'contact_id');
    }
}
