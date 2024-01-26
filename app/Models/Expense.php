<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\ExpenseCreatedNotification;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'date',
        'value',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($expense) {
            $expense->user->notify(new ExpenseCreatedNotification($expense));
        });
    }

    /**
     * Get the user that owns the expense.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
