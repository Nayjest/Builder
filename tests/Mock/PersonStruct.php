<?php
namespace Nayjest\Builder\Test\Mock;

class PersonStruct
{
    public $name;
    //public $address;
    //public $phone;
    protected $email;
    public $age;
    public $gender;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}