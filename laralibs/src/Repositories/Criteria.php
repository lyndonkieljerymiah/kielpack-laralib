<?php

namespace KielPack\Laralibs\Repositories;


abstract class Criteria {

    
    protected abstract function apply();

    public function execute() {
        $this->apply();
    }
}