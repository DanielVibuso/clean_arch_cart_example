<?php

namespace LittleCommerce\Domain\Shared\Repository;

interface RepositoryInterface {
    public function create($data);
    public function toArray();
}

