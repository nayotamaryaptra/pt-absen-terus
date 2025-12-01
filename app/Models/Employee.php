<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id','nik','fullname','position','department','phone',
        'photo','address','hired_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => '-',
            'email' => '-'
        ]);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
