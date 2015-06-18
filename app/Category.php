<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = 'categories';

    protected $fillable = ['name', 'description'];

    public static function selectCategories()
    {
        $categories = Category::all();
        $selectCategories = [
            '' => '-- Select Category --'
        ];
        foreach($categories as $category)
        {
            $selectCategories[$category->id] = $category->name;
        }
        return $selectCategories;
    }
    
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
