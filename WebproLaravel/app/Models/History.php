<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Kolom foreign key ke tabel users
        'title',
        'description',
        'category',
        'due_date',
        'priority',
        'done_at',
    ];
    protected $table = 'history';

    // Definisikan relasi dengan model User (optional jika Anda membutuhkan relasi lebih lanjut)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
