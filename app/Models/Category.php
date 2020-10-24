<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property int $eId
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['title', 'eId'];

    public function rules()
    {
        return [
            'title' => 'required|min:3|max:12',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title обязательное поле',
            'title.min' => 'Title должен иметь иметь минимум :min символов',
            'title.max' => 'Title должен иметь иметь максимум :max символов',
        ];
    }

    public static function list()
    {
        return Category::pluck('title', 'id');
    }
}
