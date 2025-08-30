<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id','client_id','invoice_number','invoice_date','due_date','total_amount'];

    protected $dates = ['invoice_date','due_date'];
   protected $casts = [
    'invoice_date' => 'datetime',
    'due_date' => 'datetime',
    ];

    public function user(){ return $this->belongsTo(User::class); }
    public function client(){ return $this->belongsTo(Client::class); }
    public function items(){ return $this->hasMany(InvoiceItem::class); }
}
