<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MulticharacterSlot extends Model
{
    protected $connection = 'second_db'; // اتصال به دیتابیس دوم
    protected $table = 'zsx_multicharacter_slots'; // نام جدول
}
