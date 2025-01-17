<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Custom where method
//    public static function where($column, $value)
//    {
//        // Simulate an SQL query builder-like behavior using Laravel's DB facade
//        return DB::table('brands')->where($column, $value)->get();
//    }

    // Mutator to set the slug when the name is set
//    public static function createSlug($name)
//    {
//        // Generate a slug from the brand name
//        $slug = Str::slug($name);
//
//        // Ensure the slug is unique
//        $originalSlug = $slug;
//        $counter = 1;
//        while (self::where('slug', $slug)->count() > 0) {  // Use the custom where method
//            $slug = $originalSlug . '-' . $counter;
//            $counter++;
//        }
//
//        return $slug;
//    }
}
