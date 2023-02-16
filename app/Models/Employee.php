<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=['first_name','last_name','phone','email','company_id'];

    public function companies()
    {
        return $this->hasOne(Company::class,'id','company_id');
    }
}
