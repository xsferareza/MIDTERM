<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table            = 'sales';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        'product_id',
        'customer_id',
        'sold_by',
        'quantity',
        'total_amount',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = false;
}