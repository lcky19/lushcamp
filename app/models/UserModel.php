<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model
{
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct() { parent::__construct(); }

    public function getByEmail($email)
    {
        return $this->db->table($this->table)
                        ->where('email', $email)
                        ->get();
    }
}
?>
