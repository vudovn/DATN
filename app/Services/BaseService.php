<?php  
namespace App\Services;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BaseService {
    
    public function __construct(){

    }

    public function log($e){
        Log::error('Error Message: '. $e->getMessage());
        Log::error('File: '. $e->getFile(). ' Line: '. $e->getLine());
        Log::error('Stack trace: ' . $e->getTraceAsString());
    }

    public function changeStatusByField($data){
        DB::beginTransaction();
        try {
            $repositoryClass = loadClass($data['model'], 'Repository');
            $payload[$data['field']] = ((int)$data['value'] === 2) ? 1 : 2;
            $repositoryClass->update((int)$data['id'], $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
           DB::rollback();
            // echo $e->getMessage();die();
            $this->log($e);
            return false;
        }
    }

    public function bulkChangeStatus($data){
        DB::beginTransaction();
        try {
            $repositoryClass = loadClass($data['model'], 'Repository');

            $option = explode('-', $data['option']);
            $payload[$option[0]] = (int)$option[1];
            $agruments = [
                'whereInField' => 'id',
                'whereIn' => $data['ids'],
                'payload' => $payload
            ];
            $repositoryClass->updateByWhereIn(...$agruments);

            DB::commit();
            return true;
        } catch (\Exception $e) {
           DB::rollback();
            echo $e->getMessage();die();
            // $this->log($e);
            return false;
        }
    }

    public function bulkDelete($data){
        DB::beginTransaction();
        try {
            $repositoryClass = loadClass($data['model'], 'Repository');
            $agruments = [
                'whereInField' => 'id',
                'whereIn' => $data['ids'],
            ];
            $repositoryClass->deleteByWhereIn(...$agruments);

            DB::commit();
            return true;
        } catch (\Exception $e) {
           DB::rollback();
            echo $e->getMessage();die();
            // $this->log($e);
            return false;
        }
    }

}