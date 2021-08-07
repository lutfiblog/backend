<?php namespace App\Models;

use CodeIgniter\Model;

class MonitoringModel extends Model {
    protected $table = 'monitoring';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sensor1','sensor2','sensor3','sensor4','sensor5','sensor6','created_at'];
}