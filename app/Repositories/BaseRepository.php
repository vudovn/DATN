<?php  
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;

class BaseRepository {
    
    protected $model;

    public function __construct(
        Model $model
    ){
        $this->model = $model;
    }

    public function pagination(){
        return $this->model->paginate(20);
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

}