<?php


namespace app\models;

use app\core\DbModel;
use app\core\Model;

class User extends DbModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public string $fname = '';
    public string $lname = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $cpassword = '';

    public function tableName(): string
    {
        return 'user';
    }

    public function save(){
        $this->password = password_hash( $this->password, PASSWORD_DEFAULT );
        return parent::save();
    }

    public function rules() : array
    {
        return [
            'fname' => [self::RULE_REQUIRED],
            'lname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class] ],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8 ], [self::RULE_MAX, 'max' => 40 ] ],
            'cpassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password'] ],
        ];
    }

    public function attributes(): array
    {
        return [
            'fname',
            'lname',
            'email',
            'password',
            'status'
        ];
    }

    public function labels(): array
    {
        return [
            'fname' => 'First name',
            'lname' => 'Last name',
            'email' => 'Email',
            'password' => 'password',
            'cpassword' => 'Confirm password',
        ];
    }
}