<?php

class Student
{
    private $id;
    private $name;
    private $surname;
    private $group_name;

    public function __construct($id, $name, $surname, $group_name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->group_name = $group_name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getGroupName()
    {
        return $this->group_name;
    }

    public function setGroupName($group_name)
    {
        $this->group_name = $group_name;
    }
}