<?php

namespace LaraLibs\Repositories;

interface IRepositories {
    
    public function all($columns = array('*'),$relations = null);
    public function find($id,$columns = array('*'),$relations = null);
    public function findBy($field, $value,$columns = array('*'),$relations = null);
    public function paginate($perPage = 20,$columns = array('*'),$relations = null);
    
    public function create(Array $data,$children = array());
    public function createWithUser(Array $data,$children = array());
    public function delete($id);
    public function update($id, Array $data,$attribute = 'id');
    public function updateWithUser($id, Array $data, $attribute = 'id');
}

