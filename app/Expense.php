<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    public $table = 'expenses';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'expense_date',
    ];

    protected $fillable = [
        'description',
        'category_id',
        'program_id',
        'unit_measure',
        'period',
        'quantity',
        'amount',
        'total_exclusive',
        'vat',
        'total_inclusive',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function program()
    {
        return $this->belongsTo(Programm::class, 'programe_id');
    }
}
