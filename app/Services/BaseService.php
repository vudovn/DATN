<?php  
namespace App\Services;
use Illuminate\Support\Facades\Log;

class BaseService {
    
    public function __construct(){

    }

    public function log($e){
        Log::error('Error Message: '. $e->getMessage());
        Log::error('File: '. $e->getFile(). ' Line: '. $e->getLine());
        Log::error('Stack trace: ' . $e->getTraceAsString());
    }

}