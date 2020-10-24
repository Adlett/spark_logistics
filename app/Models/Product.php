<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * @property integer $id
 * @property string $title
 * @property float $price
 * @property int $eId
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends Model
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
    protected $fillable = ['title', 'price', 'eId'];

    protected static function boot()
    {
        parent::boot();

        self::updated(function ($model) {
            Mail::send('emails.welcome', array('model' => $model), function($message)
            {
                $message->to(
                    env('MAIL_TO_ADDRESS', 'begmanov.adlet@gmail.com2'),
                    env('MAIL_TO_NAME', 'Получатель')
                )->subject('Product updated!');
                $message->from(
                    env('MAIL_FROM_ADDRESS', 'begmanov.adlet@gmail.com'),
                    env('MAIL_FROM_NAME', 'Адлет')
                );
            });
        });

        self::created(function ($model) {
            Mail::send('emails.welcome', array('model' => $model), function($message)
            {
                $message->to(
                    env('MAIL_TO_ADDRESS', 'begmanov.adlet@gmail.com2'),
                    env('MAIL_TO_NAME', 'Получатель')
                )->subject('Product created!');
                $message->from(
                    env('MAIL_FROM_ADDRESS', 'begmanov.adlet@gmail.com'),
                    env('MAIL_FROM_NAME', 'Адлет')
                );
            });
        });
    }

    public function rules()
    {
        return [
            'title' => 'required|min:3|max:12',
            'price' => 'required|numeric|min:0|max:200'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title обязательное поле',
            'title.min' => 'Title должен иметь иметь минимум :min символов',
            'title.max' => 'Title должен иметь иметь максимум :max символов',
            'price.required' => 'Цена обязательна',
            'price.numeric' => 'Цена должна быть числом',
            'price.min' => 'Цена должна быть минимум :min',
            'price.max' => 'Цена должна быть максимум :max',
        ];
    }

    public function getCategoryIds()
    {
        return ProductCategory::where('product_id', $this->id)->pluck('category_id')->toArray();
    }
}
