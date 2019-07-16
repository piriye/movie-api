<?php

namespace App\Utilities;

class ErrorCode
{
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const INTERNAL_ERROR = 'INTERNAL_ERROR';
    const RECORD_DOES_NOT_EXIST = 'RECORD_DOES_NOT_EXIST';
    const RECORD_EXISTING = 'RECORD_EXISTING';
    const RECORD_NOT_CREATED = 'RECORD_NOT_CREATED';
    const RECORD_NOT_UPDATED = 'RECORD_NOT_UPDATED';
    const RECORD_NOT_DELETED = 'RECORD_NOT_DELETED';
    const EXTERNAL_SOURCE_ERROR = 'EXTERNAL_SOURCE_ERROR';
    const INVALID_INPUT = 'INVALID_INPUT';
    const MODEL_INVALID_INPUT = 'MODEL_INVALID_INPUT';
    const INVALID_CRED = 'INVALID_CRED';
    const ACCESS_DENIED = 'ACCESS_DENIED';
    const ROUTE_NOT_FOUND = 'ROUTE_NOT_FOUND';
    const CANNOT_PERFORM_ACTION = 'CANNOT_PERFORM_ACTION';
    const DUPLICATE_ENTRY = 'DUPLICATE_ENTRY';
    const BAD_REQUEST = 'BAD_REQUEST';
}
