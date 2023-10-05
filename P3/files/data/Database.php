<?php

class Database
{
    protected $db = null;

    public function __construct()
    {
        $this->db = new mysqli("db", "user", "password", "appDB");
    }
}