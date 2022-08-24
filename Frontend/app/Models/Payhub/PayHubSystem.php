<?php

namespace Frontend\Models\PayHub;

use Cviebrock\EloquentSluggable\Sluggable;
use Egorovwebservices\Payhub\Models\System;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $key
 * @property int $is_default
 * @property int $is_recurrent
 * @property int $has_3ds
 * @property string $urlApi
 * @property string $partnerKey
 * @property string $seviceKey
 * @property string $secretKey
 */
class PayHubSystem extends System
{
    use HasFactory,
        Sluggable;

    protected $table = 'payhub_systems';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $dates = ['published_at'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'key',
        'urlApi',
        'partnerKey',
        'seviceKey',
        'secretKey',
        'urlSuccess',
        'urlFailed',
    ];

    /**
     * @return \string[][]
     */
    public function sluggable(): array
    {
        return [
            'key' => [
                'source' => 'name'
            ]
        ];
    }

    public function getKeyColumn(): string
    {
        return 'key';
    }

    public function getIsDefaultColumn(): string
    {
        return 'is_default';
    }

    public function getIsRecurrentColumn(): string
    {
        return 'is_recurrent';
    }

    public function getHas3dsColumn(): string
    {
        return 'has_3ds';
    }

    public function getId(): int
    {
        return $this->id;
    }
}
