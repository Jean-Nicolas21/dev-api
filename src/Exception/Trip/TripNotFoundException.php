<?php

namespace App\Exception\Trip;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TripNotFoundException extends HttpException
{
    public function __construct()
    {
        parent::__construct(
            Response::HTTP_NOT_FOUND,
            'Trip not found');
    }
}
