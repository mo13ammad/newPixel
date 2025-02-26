<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players'; // نام جدول
    protected $primaryKey = 'id'; // کلید اصلی
    public $timestamps = false; // اگر جدول شما timestamp ندارد

    protected $fillable = [
        'userId', 'citizenid', 'license', 'name', 'money', 'charinfo', 'position'
    ];

    // تبدیل فیلدهای JSON به آرایه
    protected $casts = [
        'money' => 'array',
        'charinfo' => 'array',
        'position' => 'array',
    ];
}
