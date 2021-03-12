<?php

namespace Core\Validation;

class Validator
{
    private $isValid = true;
    private $errors = [];

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getError($fieldName)
    {
        return isset($this->errors[$fieldName]) ? $this->errors['fieldName'] : '';
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function validate(array $rules, array $payload)
    {
        foreach ($rules as $rule) {
            if (!$this->validateRequired($rule, $payload)) {
                continue;
            }
            if (!$this->validateMinLength($rule, $payload)) {
                continue;
            }
            if (!$this->validateMaxLength($rule, $payload)) {
                continue;
            }
            switch ($rule['type']) {
                case 'text':
                    $this->validateText($rule, $payload);
                    break;
                case 'email':
                    $this->validateEmail($rule, $payload);
                    break;
                case 'phone':
                    $this->validatePhone($rule, $payload);
                    break;
                    //extend with other validation rules as needed
            }
        }

        return $this->isValid();
    }

    public function validateRequired(array $rule, array $payload)
    {
        if (true === $rule['required'] && (!isset($payload[$rule['fieldName']]) || $payload[$rule['fieldName']] === "")) {
            $this->isValid = false;
            $this->errors[$rule['fieldName']] = 'This field is required';

            return false;
        }

        return true;
    }

    public function validateMinLength(array $rule, array $payload)
    {
        if (isset($rule['minLength']) && (!isset($payload[$rule['fieldName']]) || strlen($payload[$rule['fieldName']]) < $rule['minLength'])) {
            $this->isValid = false;
            $this->errors[$rule['fieldName']] = 'The length of this field cannot be less than '. $rule['minLength'];

            return false;
        }

        return true;
    }

    public function validateMaxLength(array $rule, array $payload)
    {
        if (isset($rule['maxLength']) && (!isset($payload[$rule['fieldName']]) || strlen($payload[$rule['fieldName']]) > $rule['maxLength'])) {
            $this->isValid = false;
            $this->errors[$rule['fieldName']] = 'The length of this field cannot exceed '. $rule['maxLength'];

            return false;
        }

        return true;
    }

    public function validateText($rule, $payload)
    {
        // Checkup logic, set $this->isValid to false if not valid, add
        // See add $this->errors[$rule['fieldname']] = 'your message';

        if (!preg_match('/^[a-zA-Z\s]*$/', $payload[$rule['fieldName']])) {
            $this->isValid = false;
            $this->errors[$rule['fieldName']] = 'This field must be text only';
        }
    }

    public function validateEmail($rule, $payload)
    {
        // Checkup logic, set $this->isValid to false if not valid, add
        // See add $this->errors[$rule['fieldname']] = 'your message';

        if (!preg_match('/\S+@\S+\.\S+/', $payload[$rule['fieldName']])) {
            $this->isValid = false;
            $this->errors[$rule['fieldName']] = 'This field must be a valid email';
        }
    }

    public function validatePhone($rule, $payload)
    {
        // Checkup logic, set $this->isValid to false if not valid, add
        // See add $this->errors[$rule['fieldname']] = 'your message';

        if (!preg_match('/^\d+$/', $payload[$rule['fieldName']])) {
            $this->isValid = false;
            $this->errors[$rule['fieldName']] = 'This field must be a valid phone with only numbers';
        }
    }
}