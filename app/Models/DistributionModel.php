<?php

namespace App\Models;

use CodeIgniter\Model;

class DistributionModel extends Model
{
    protected $table      = 'distributions';
    protected $primaryKey = 'distribution_id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['driver_id', 'product_id', 'distribution_destination', 'distribution_datetime', 'distribution_description', 'distribution_progress'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $dateFormat   = 'datetime';
    
}