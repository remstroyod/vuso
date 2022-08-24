<?php
namespace Frontend\Models\Support;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasTranslations;

    /**
     * @var string
     */
    protected $table = 'support_faq';

    /**
     * @var string[]
     */
    public $translatable = ['name', 'description'];

}
