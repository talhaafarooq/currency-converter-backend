<?php

namespace App\Enums;

enum MessageEnum: string
{
    case SUCCESS_MESSAGE = 'Operation completed successfully.';
    case ERROR_MESSAGE = 'Operation failed.';
    case VALIDATION_ERROR_MESSAGE = 'Validation Error.';
    case USER_NOT_FOUND_MESSAGE = 'User Not Found.';
}
