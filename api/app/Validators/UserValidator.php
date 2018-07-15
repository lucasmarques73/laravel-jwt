<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'cpf' => 'required|unique:users,cpf',
            'password' => 'required',
            'email' => 'required|email|unique:users,email',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'cpf' => 'required|unique:users,cpf',
            'email' => 'required|email|unique:users,email',
        ],
    ];

    /**
     * Validation Messages
     *
     * @var array
     */
    protected $messages = [
        'required' => 'The :attribute field is required.',
        'unique' => 'The :attribute field must be unique'
    ];
}
