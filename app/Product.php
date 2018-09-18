<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App
 * @property string $name
 * @property text $description
 * @property decimal $price
 * @property string $photo1
 
 * @property string $service_provider
*/
class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'photo1','photo2','photo3', 'serviceprovider_id'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPriceAttribute($input)
    {
        $this->attributes['price'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCategoryIdAttribute($input)
    {
        $this->attributes['category_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setServiceProviderIdAttribute($input)
    {
        $this->attributes['serviceprovider_id'] = $input ? $input : null;
    }
    
    public function tag()
    {
        return $this->belongsToMany(ProductTag::class, 'product_product_tag');
    }
    
    public function category()
    {
        return $this->belongsToMany(ProductCategory::class);
    }
    
    public function serviceprovider()
    {
        return $this->belongsTo(Serviceprovider::class);
    }
    
}
