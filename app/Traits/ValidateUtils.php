<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

/**
 * Common Utils for validator
 *  
 */
trait ValidateUtils
{
    /**
     * Function to validate any input.
     * Returns array when validation fails else returns null. 
     */
    public function validate_input($input, $rules = [], $message = [])
    {
        $validator = Validator::make($input, $rules, $message);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        return null;
    }
}
