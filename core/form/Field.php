<?php


namespace app\core\form;

use app\core\Model;


class Field
{
    public const TYPE_TXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public Model $model;
    public string $attribute;
    public string $type;

    public function __construct( $model, $attribute )
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = self::TYPE_TXT;
    }

    public function field()
    {
        return '<div>Field</div>';
    }

    public function __toString()
    {
        return sprintf('
                <div class="form-group">
                   <label>%s</label>
                   <input type="%s"  name="%s" value="%s" class="form-control %s">
                   <div class="invalid-feedback">
                        %s
                   </div>
                </div>
                ',
            ucfirst( $this->attribute ),
            $this->type,
            $this->attribute,
            $this->model-> {$this->attribute},
            $this->model->hasError( $this->attribute ) ? 'is-invalid' : '',
            $this->model->getFirstError( $this->attribute )
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}