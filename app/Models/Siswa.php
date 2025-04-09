<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nis',
        'name',
        'kelas',
        'jurusan',
        'jenis_kelamin',
    ];

    public function siswa() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
