<?php

namespace KielPack\LaraLibs\Repositories;


interface ICriteria {

    public function skipCriteria($status = true);

    public function getCriteria();

    public function getByCriteria(Criteria $criteria);

    public function pushCriteria(Criteria $criteria);

    public function applyCriteria();
}