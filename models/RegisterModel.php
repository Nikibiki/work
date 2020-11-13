<?php


namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{
    public $fname;
    public $lname;
    public $email;
    public $password;
    public $cpassword;

    public function save()
    {

    }

    public function rules() : array
    {
        return [
            'fname' => [self::RULE_REQUIRED],
            'lname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8 ], [self::RULE_MAX, 'max' => 40 ] ],
            'cpassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password'] ],
        ];
    }
}