<?php


namespace app\core;


abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public $errors = [];

    public function labels() : array {
        return [];
    }

    public function getLabel( $attribute ){
        return $this->labels()[$attribute] ?? $attribute;
    }

    public function load( $data )
    {
        foreach( $data as $key => $value ){
            if (property_exists( $this, $key ) ) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate()
    {
        foreach ( $this->rules() as $attr => $rules ){
            $value = $this->{$attr};

            foreach( $rules as $rule ){
                $ruleName = $rule;
                if ( is_array( $ruleName ) ){
                    $ruleName = $rule[0];
                }
                if ( $ruleName === self::RULE_REQUIRED && !$value ){
                    $this->addError( $attr, self::RULE_REQUIRED );
                }
                if( $ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL ) ) {
                    $this->addError( $attr, self::RULE_EMAIL );
                }
                if( $ruleName === self::RULE_MIN && strlen( $value ) < $rule['min'] ){
                    $this->addError( $attr, self::RULE_MIN, $rule );
                }
                if( $ruleName === self::RULE_MAX && strlen( $value ) > $rule['max'] ){
                    $this->addError( $attr, self::RULE_MAX, $rule );
                }
                if( $ruleName === self::RULE_MATCH &&  $value  !== $this->{$rule['match']} ){
                    $this->addError( $attr, self::RULE_MATCH, $rule );
                }
                if( $ruleName === self::RULE_UNIQUE ){
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attr;
                    $tableName = $className::tableName();
                    $stmt = App::$app->db->prepare("select * from $tableName where $uniqueAttr = :attr");
                    $stmt->bindValue( ":attr", $value );
                    $stmt->execute();
                    $record = $stmt->fetchObject();
                    if( $record ){
                        $this->addError( $attr, self::RULE_UNIQUE, ['field' => $this->getLabel($attr) ]);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function addError( $attribute, string $rule, $params = [] )
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value ){
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'Record with this {field} already exists',
        ];
    }

    abstract public function rules() : array;

    public function hasError( $attribute )
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? '';
    }


}