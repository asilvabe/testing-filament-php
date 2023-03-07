<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Merchant.
 *
 * @property int         $id
 * @property string      $name
 * @property string|null $brand
 * @property string      $country_id
 * @property string|null $document_type_id
 * @property string|null $document
 * @property string|null $website_url
 * @property string|null $size
 * @property string      $increment_type
 * @property Carbon|null $disabled_at
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 *
 * @method static Merchant factory()
 */
class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'document_type_id',
        'name',
        'brand',
        'document',
        'website_url',
        'size',
        'increment_type',
        'disabled_at',
    ];

    protected $casts = [
        'isEnabled' => 'boolean',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }
}
