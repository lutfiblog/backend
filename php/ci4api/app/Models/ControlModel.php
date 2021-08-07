<?php namespace App\Models;

use CodeIgniter\Model;

class ControlModel extends Model {
    protected $table = 'control';
    protected $primaryKey = 'id';
    protected $allowedFields = ['control1','control2','control3','control4','control5'];
}