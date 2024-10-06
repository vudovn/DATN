<?php  
namespace App\Repositories\User;
use App\Repositories\BaseRepository;
// use App\Models\User;

class UserCatalogueRepository{
    
    // protected $model;

    // public function __construct(
    //     User $model
    // ){
    //     $this->model = $model;
    // }

    public function getAll(){
        return [
            ['id' => 1, 'name' => 'Administrator'],
            ['id' => 2, 'name' => 'Collaborator'],
        ];
    }

   

}