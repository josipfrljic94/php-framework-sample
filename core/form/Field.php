<?php

namespace app\core\form;
use app\core\Model;
class Field
{
    //TYPE CONST-S
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_EMAIL = 'email';
    public const TYPE_number = 'number';

    public string $type;
    public Model $model;
    public string $att;
    public function __construct(Model $model, string $att)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->att = $att;
    }

    private function getLabel(): string
    {
        return $this->att ?? "";
    }

    private function getType()
    {
        return $this->type ?? self::TYPE_TEXT;
    }

    private function getErrorMsg(): string
    {
        return $this->model->hasError($this->att) ? " is-invalid" : "";
    }

    private function getValue(): string|int
    {
        return $this->model->{ $this->att} ?? "";
    }

    private function getFirstError(): string
    {
        return $this->model->getFirstError($this->att) ?? "";
    }

    public function __toString()
    {
        return sprintf('<div class="form-group">
                <label>%s</label>
                <input type="%s" class="form-control%s" name="%s" value="%s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>',
            $this->getLabel(),
            $this->getType(),
            $this->getErrorMsg(),
            $this->getLabel(),
            $this->getValue(),
            $this->getFirstError()
        );
    }


    public function customizeFieldType($type = self::TYPE_TEXT)
    {
        $this->type = $type;
        return $this;
    }

}
