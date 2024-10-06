<?php   
use Illuminate\Support\Carbon;
if (!function_exists('loadClass')) {
    function loadClass($modelName = '', $classType = '', $isSubFolder = true) {
        
        $type = [
            'Service' => 'Services',
            'Repository' => 'Repositories'
        ];
        $modelParts = preg_split('/(?=[A-Z])/', $modelName);
        $baseModel = $modelParts[1];

        $classWithSubFolder = 'App\\' . $type[$classType] . '\\' . $baseModel . '\\' . $baseModel . $classType;
        $classFullWithoutSubFolder = 'App\\' . $type[$classType] . '\\' . $modelName . $classType;
        $classFullWithSubFolder = 'App\\' . $type[$classType] . '\\' . $baseModel . '\\' . $modelName . $classType;
        $classWithoutSubFolder = 'App\\' . $type[$classType] . '\\' . $baseModel . $classType;
        
        // dd(class_exists($classWithSubFolder),
        //     class_exists($classFullWithSubFolder),
        //     class_exists($classWithoutSubFolder),
        //     class_exists($classFullWithoutSubFolder)
        // );

        // Trả về class tồn tại
        if (class_exists($classFullWithSubFolder)) {
            return app($classFullWithSubFolder);
        }

        if (class_exists($classFullWithoutSubFolder)) {
            return app($classFullWithoutSubFolder);
        }

        if (class_exists($classWithSubFolder)) {
            return app($classWithSubFolder);
        }

        if (class_exists($classWithoutSubFolder)) {
            return app($classWithoutSubFolder);
        }

        // Nếu không tìm thấy class
        throw new Exception("Class {$modelName} không tồn tại trong {$type[$classType]}");
    }
}


if(!function_exists('generateSelect')){
    function generateSelect($root = 'Choose', $options = null, $keyName = 'id', $valueName = 'name'){
        $select[0] = $root;
        // dd($options);
        if(isset($options) && !empty($options)){
            foreach($options as $key => $option){
                if(is_array($option)){
                    $select[$option[$keyName]] = $option[$valueName];
                }else if(is_object($option)){
                    $select[$option->{$keyName}] = $option->{$valueName};
                }
            }
        }          
        return $select;
    }
}

if(!function_exists('changeDateFormat')){
    function changeDateFormat($date, $format = 'Y-m-d'){
       return Carbon::parse($date)->format($format);
    }
}

if(!function_exists('cutUrl')){
    function cutUrl($url, $host = "http://127.0.0.1:8000/"){
        // dd(str_replace($host, '', $url));
       return str_replace($host, '', $url);
    }
}
