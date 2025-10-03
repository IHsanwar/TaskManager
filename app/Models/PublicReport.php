<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicReport extends Model
{
    /** @use HasFactory<\Database\Factories\PublicReportFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
    ];
    public function creator ()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
