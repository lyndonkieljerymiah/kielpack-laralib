<?php

namespace KielPack\LaraLibs\Repositories;

interface IRepositories {
    
    public function all($columns = array('*'));
    public function find($id,$columns = array('*'));
    public function findBy($field, $value,$columns = array('*'));
    public function paginate($perPage = 20,$columns = array('*'));
    
    public function create(array $data);
    public function delete($id);
    public function update($id, array $data,$attribute = 'id');
}

