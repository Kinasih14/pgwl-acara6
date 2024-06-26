<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    use HasFactory;
    protected $table = 'table_points';
    protected $fillable = [
        'name',
        'description',
        'geom',
    ];

    public function points()
{
    return $this->select(DB::raw('id, name, description, ST_AsGeoJSON(geom) as geom, created_at, updated_at'))->get();
}

}



