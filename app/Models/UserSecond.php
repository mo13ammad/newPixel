<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSecond extends Model
{
    protected $connection = 'second_db'; // اتصال به دیتابیس دوم
    protected $table = 'users'; // نام جدول

    public function multicharacterSlot()
    {
        return $this->hasOne(MulticharacterSlot::class, 'identifier', 'license2');
    }
}
