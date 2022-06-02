<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use BaoPham\DynamoDb\DynamoDbModel as Model;

class Form extends Model
{
    protected $table='forms';

    protected $fillable=[
        'id',
        'organization_id',
        'attributes',
        'form_id'
    ];
}
