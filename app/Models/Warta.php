<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warta extends Model
{
    protected $fillable = [
        'title',
        'edition_date',
        'summary',
        'pdf_path',
        'is_published',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'edition_date' => 'date',
            'is_published' => 'boolean',
        ];
    }
}