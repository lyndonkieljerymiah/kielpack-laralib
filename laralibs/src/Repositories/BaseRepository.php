<?php

namespace Laralibs\Repositories;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

abstract class BaseRepository implements IRepositories
{
    protected $query;

    protected $app;

    protected $model;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    protected abstract function model();

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    public function all($columns = array('*'),$relations = null)
    {
        if(!is_null($relations)) {
            return $this->model->with($relations)->get();
        }
        else {
            return $this->model->get($columns);
        }
    }

    public function find($id, $columns = array('*'),$relations = null)
    {
        if(!is_null($relations)) {
            $this->model->with($relations)->find($id,$columns);
        }
        else {
            return $this->model->find($id, $columns);
        }
    }

    public function findBy($field, $value, $columns = array('*'),$relations = null)
    {
        if(!is_null($relations)) {
            $this->model = $this->model->with($relations);
        }

        return $this->model->where($field, '=', $value)->first($columns);
    }

    public function paginate($perPage = 20, $columns = array('*'),$relations = null)
    {
        if(!is_null($relations)) {
            $this->model = $this->model->with($relations);
        }

        return $this->model->paginate($perPage, $columns);
    }

    /*
     *
     * $children = [
     *  'payment' => function(&model) {  }
     * ]
     * */
    public function create(Array $data,$children = array())
    {
        $this->model = $this->model->create($data);

        if(count($children) > 0) {
            foreach ($children as $key => $callback) {
                if(is_callable($callback)) {
                    $callback($this->model);
                }
            }
        }

        return $this->model;
    }

    public function createWithUser(Array $data,$children = array())
    {
        $data['user_id'] = Auth::user()->getAuthIdentifier();

        return $this->create($data,$children);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function update($id, array $data, $attribute = 'id')
    {
        $this->model = $this->model->where($attribute, $id)->first();

        $this->model->toMap($data);

        $this->model->save();

        return $this->model;
    }

    public function updateWithUser($id, array $data, $attribute = 'id')
    {
        $data["user_id"] = Auth::user()->getAuthIdentifier();

        return $this->update($id,$data,$attribute);
    }

    protected function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Model");
        }

        $this->model = $model;
    }


}
