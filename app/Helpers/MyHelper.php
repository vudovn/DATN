<?php   
    
if(!function_exists('loadClass')){
    function loadClass($modelName = '', $classType = '', $isSubFolter = true){
        $type = [
            'Service' => 'Services',
            'Repository' => 'Repositories'
        ];

        $modelParts = preg_split('/(?=[A-Z])/', $modelName);
        $baseModel = $modelParts[1];

        $classWithSubFolder = 'App\\'. $type[$classType] . '\\' . $baseModel . '\\' . $baseModel . $classType;
        $classWithOutSubFolder = 'App\\'. $type[$classType] . '\\' . $baseModel . $classType;
       
        if(class_exists($classWithSubFolder)){
            return app($classWithSubFolder);
        }else if(class_exists($classWithOutSubFolder)){
            return app($classWithSubFolder);
        }

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