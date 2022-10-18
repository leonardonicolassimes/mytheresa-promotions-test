<?php 
namespace App\Models;
   
use Illuminate\Database\Eloquent\Model;
   
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['sku', 'name', 'category', 'price', 'discount_percentage'];
}
?>