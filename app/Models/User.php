<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name','email','password','role'];
    protected $hidden = ['password','remember_token'];

    public function clients() { return $this->hasMany(Client::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }

    public function isAdmin(): bool { return $this->role === 'admin'; }
}
