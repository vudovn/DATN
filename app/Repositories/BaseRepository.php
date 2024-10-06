<?php  
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;


class BaseRepository {
    
    protected $model;

    public function __construct(
        Model $model
    ){
        $this->model = $model;
    }

    public function pagination(array $params = []){


        return $this->model
                    ->condition($params['condition'] ?? [])
                    ->keyword($params['keyword'] ?? [])
                    ->orderBy($params['sort'][0], $params['sort'][1])
                    ->paginate($params['perpage']);
        
    }

    
    public function create(array $payload = []){
        return $this->model->create($payload);
    }

    public function update(int $id, array $payload = []){
        return $this->findById($id)->fill($payload)->save();
    }
   
    public function findById(int $id, array $relation = [], array $select = ['*']){
        return $this->model->select($select)->with($relation)->find($id);
    }

    public function delete(int $id){
        return $this->findById($id)->delete();
    }

    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []){
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }

    public function deleteByWhereIn(string $whereInField, array $whereIn = []){
        return $this->model->whereIn($whereInField, $whereIn)->delete();
    }

}