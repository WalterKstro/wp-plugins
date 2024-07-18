<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

if( !class_exists('Responses') ){
    class Responses
    {
        const SUCCESS = 200;
        const CREATED = 201;
        const BAD_REQUEST = 400;
        const UNAUTHORIZED = 401;
        const NOT_FOUND = 404;
        const SERVER_ERROR = 500;
    }
}