<?php
namespace App\Services\Setting;
use App\Services\BaseService;
use App\Repositories\Setting\SettingRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;



class SettingService extends BaseService
{
    protected $settingRepository;
    public function __construct(
        SettingRepository $settingRepository
    ) {
        $this->settingRepository = $settingRepository;
    }


    private function paginateAgrument($request)
    {
        // dd($request);
        return [
            'keyword' => [
                'search' => $request['keyword'] ?? '',
                'field' => ['name', 'email', 'phone', 'address', 'created_at']
            ],
            'condition' => [
                'publish' => isset($request['publish'])
                    ? (int) $request['publish']
                    : null,
            ],
            'sort' => isset($request['sort']) && $request['sort'] != 0
                ? explode(',', $request['sort'])
                : ['id', 'asc'],
            'perpage' => (int) (isset($request['perpage']) && $request['perpage'] != 0 ? $request['perpage'] : 10),
        ];
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', '_method', 'send');
            $payload['site_social'] = json_encode($payload['site_social']);
            $this->settingRepository->update(1, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


}