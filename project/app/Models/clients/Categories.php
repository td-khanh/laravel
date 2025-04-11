<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Categories extends Model
{
    use HasFactory;
    protected $primaryKey = 'CategoryID';
    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = [
        'CategoryName',
        'Description',
        'Picture',
    ];

    public function getAll()
    {
        $categories = DB::table($this->table)
        ->get();
        return $categories;
    }
}
