<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function set_cors_headers()
{
    // Set CORS headers
    header("Access-Control-Allow-Origin: http://localhost:8080");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
}
