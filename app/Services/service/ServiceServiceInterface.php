<?php

namespace App\Services\service;

interface ServiceServiceInterface
{
    public function getAllServices();
    public function createService(array $data);
}
