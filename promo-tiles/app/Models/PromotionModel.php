<?php

namespace App\Models;

use CodeIgniter\Model;

class PromotionModel extends Model
{
    protected $table = 'promotions';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'title',
        'description',
        'image_url',
    ];
}
