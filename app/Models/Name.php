<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'description',
        'status_id'
    ];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function scopeByName($query, $name)
    {
        if($name) {
            return $query->where('name', 'like', '%' . $name . '%');
        }
        return $query;
    }

    public function scopeByStatus($query, $status)
    {
        if($status) {
            return $query->whereHas('status', function($q) use($status){
                        $q->where('id', $status);
                    });
        }
        return $query;
    }

    public function scopeByDate($query, $date)
    {
        if($date) {
            return $query->whereDate('updated_at', Carbon::parse($date)->toDateString());
        }
        return $query;
    }
}
