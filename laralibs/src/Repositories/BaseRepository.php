<?php 

namespace  KielPack\Laralibs\Repositories;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use KielPack\LaraLibs\Repositories\IRepositories;
use Illuminate\Contracts\Container\Container as ContainerContract;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

abstract  class BaseRepository implements IRepositories {


    protected $query;

    protected  $app;

    protected $model;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    protected  abstract function model();

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    public function findBy($field, $value, $columns = array('*'))
    {
        return $this->model->where($field, '=', $value)->first($columns);
    }

    public function paginate($perPage = 20, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function update($id, array $data,$attribute = 'id')
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    protected function makeModel() 
    {
        $model = $this->app->make($this->model());
        if(!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Model");
        }

        $this->model = $model;
    }

    

}
