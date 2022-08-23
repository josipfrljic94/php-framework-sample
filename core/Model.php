<?php

namespace app\core;
abstract class Model
{
    public const RULE_REQUIRED = "required";
    public const RULE_EMAIL = "email";
    public const RULE_MIN = "min";
    public const RULE_MAX = "max";
    public const RULE_UNIQUE = "unique";
    public const RULE_MATCH = "match";


    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{ $key} = $value;
            }
            else {
                $this->{ $key} = null;
            }
        }
    }

    abstract public function rules(): array;

    public function validate()
    {
        foreach ($this->rules() as $att => $rules) {
            $value = null;
            if ($this->{ $att}) {
                $value = $this->{ $att};
            }
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($att, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($att, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule[self::RULE_MIN]) {
                    $this->addError($att, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule[self::RULE_MAX]) {
                    $this->addError($att, self::RULE_MAX, $rule);
                }
            }
        }
        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule, $params = [])
    {
        echo $attribute . ': ' . $rule . ': ';
        $message = $this->errorMessages()[$rule] ?? "";
        if (count($params) > 0) {
            $descWord = $params[$rule];
            if ($descWord) {
                $message = str_replace("{{$rule}}", $descWord, $message);
            }
        }

        $this->errors[$attribute][] = $message;

    }
    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($att): string
    {
        if (!$this->hasError($att)) {
            return "";
        }

        return $this->errors[$att][0];
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => "THIS FIELD IS REQUIRED",
            self::RULE_EMAIL => "THIS FIELD MUST BE VALID EMAIL",
            self::RULE_MIN => "THIS FIELD MUST HAVE LENGTH MIN {min}",
            self::RULE_MAX => "THIS FIELD SHALL HAVE LENGTH MAX {max}",
            self::RULE_MATCH => "THIS FIELD MUST BE SAME AS {match}",
        ];
    }




}
