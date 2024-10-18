<?php 
namespace App\Http\Controllers\Ajax;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Location\ProvinceRepository;
use App\Repositories\Location\DistrictRepository;
use App\Repositories\Location\WardRepository;



class LocationController extends Controller {

    protected $provinceRepository;
    protected $districtRepository;
    protected $wardRepository;


    public function __construct(
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository,
        // WardRepository $wardRepository
    ){
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
    }

    public function getLocation(Request $request) {

        $get = $request->input();
        $html = '';
        if ($get['target'] == 'districts') {
            // $province = $this->provinceRepository->findByIdLocation($get['data']['location_id'], ['code', 'name'], ['districts']); cái cũ
            $province = $this->provinceRepository->findById($get['data']['location_id'],['districts'], ['code', 'name'] ); //cái mới 
            // dd($province)
            $html = $this->renderHtml($province->districts); //Gọi cái hàm renderHtml ở dưới
            // dd($province);
        } else if ($get['target'] == 'wards') {
            // $district = $this->districtRepository->findByIdLocation($get['data']['location_id'], ['code', 'name'], ['wards']); cái cũ
            $district = $this->districtRepository->findById($get['data']['location_id'],  ['wards'],['code', 'name']); //cái mới 
            $html = $this->renderHtml($district->wards, '[Chọn Phường/Xã]'); //Gọi cái hàm renderHtml ở dưới
        }
        $response = [
            'html' => $html
        ];
        return response()->json($response);
    }


     // tạo ra luôn html để trả về cho js in luôn ra giao diện 
    public function renderHtml($districts, $root = '[Chọn Quận/Huyện]')
    {
        $html = '<option value="0">' . $root . '</option>';
        foreach ($districts as $district) {
            $html .= '<option value="' . $district->code . '">' . $district->name . '</option>';
        }
        return $html;
    }

}