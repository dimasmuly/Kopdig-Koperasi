<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'credit_number'
    ];

    // RELATIONSHIPS

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
