<?php


namespace app\models;

use app\core\DbModel;
use app\core\Model;

class User extends DbModel
{
    public string $fname = '';
    public string $lname = '';
    public string $email = '';
    public string $password = '';
    public string $cpassword = '';

    public function tableName(): string
    {
        return 'user';
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