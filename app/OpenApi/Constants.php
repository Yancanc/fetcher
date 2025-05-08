<?php

/**
 * Constantes para OpenAPI
 * 
 * Este arquivo define constantes que são usadas nas anotações OpenAPI
 */

if (!defined('L5_SWAGGER_CONST_HOST')) {
    define('L5_SWAGGER_CONST_HOST', env('L5_SWAGGER_CONST_HOST', 'http://localhost:8000/api/v1'));
} 