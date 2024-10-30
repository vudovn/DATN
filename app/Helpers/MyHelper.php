<?php
use Illuminate\Support\Carbon;

if (!function_exists('loadClass')) {
    function loadClass($modelName = '', $classType = '', $isSubFolder = true)
    {

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

if (!function_exists('generateSelect')) {
    function generateSelect($root = 'Choose', $options = null, $keyName = 'id', $valueName = 'name')
    {
        $select = [];

        // Xử lý giá trị root
        if (!is_string($root) || empty($root)) {
            $root = 'Choose'; // Giá trị mặc định
        }

        $select[0] = $root;

        // Validate $options: kiểm tra xem $options có phải là iterable không
        if (is_iterable($options)) {
            foreach ($options as $option) {
                // Kiểm tra nếu là mảng và có key tương ứng
                if (is_array($option) && isset($option[$keyName], $option[$valueName])) {
                    $select[$option[$keyName]] = $option[$valueName];
                }
                // Kiểm tra nếu là object và có thuộc tính tương ứng
                elseif (is_object($option) && isset($option->{$keyName}, $option->{$valueName})) {
                    $select[$option->{$keyName}] = $option->{$valueName};
                } else {
                    // Nếu không thỏa mãn điều kiện, bỏ qua phần tử đó
                    continue;
                }
            }
        }
        return $select;
    }
}

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($date, $format = 'Y-m-d')
    {
        return Carbon::parse($date)->format($format);

    }
}

if (!function_exists('cutUrl')) {
    function cutUrl($url, $host = "http://127.0.0.1:8000/")
    {
        // dd(str_replace($host, '', $url));
        return str_replace($host, '', $url);
    }
}

if (!function_exists('getSlug')) {
    function getSlug($string)
    {
        return \Illuminate\Support\Str::slug($string);
    }
}

if (!function_exists('statusOrder')) {
    function statusOrder($status)
    {
        $status = strtolower($status);
        $statusList = __('order.status');
        return $statusList[$status] ?? 'Không xác định';
    }
}

if (!function_exists('getActionRoute')) {
    function getActionRoute()
    {
        $allRoutes = Route::getRoutes();
        $permissionAll = [];
        foreach ($allRoutes as $route) {
            if (in_array('GET', $route->methods())) {
                if (in_array('authenticated', $route->middleware())) {
                    $actionName = $route->getActionName();
                    if (strpos($actionName, '@') !== false) {
                        list($controller, $action) = explode('@', $actionName);
                        $controller = class_basename($controller);
                        $controller = str_replace('Controller', '', $controller);
                        $permissionAll[] = "$controller $action";
                    } else {
                        $permissionAll[] = $actionName;
                    }
                }
            }
        }
        return $permissionAll;
    }

}

if (!function_exists('orderCode')) {
    function orderCode($id)
    {
        return 'TGNT' . str_pad($id, 7, '0', STR_PAD_LEFT);
    }
}

if(!function_exists('convertNumber')){
    function convertNumber($number){
        return str_replace('.', '', $number);
    }
}


if(!function_exists('formatMon')){
    function formatNumber($number){
        if($number == ''){
            return '';
        }
        return number_format($number, 0, '.', '.');
    }
}