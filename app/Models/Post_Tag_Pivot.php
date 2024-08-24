<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTagPivot extends Model
{
    use HasFactory;

    // Specify the table name if it's not following Laravel's convention
    protected $table = 'post_tag';

    // Define any additional fields that are fillable (optional)
    protected $fillable = ['post_id', 'tag_id']; // Add any additional fields here

    // Disable timestamps if the pivot table doesn't have `created_at` and `updated_at`
    public $timestamps = false;
}
