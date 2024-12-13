<?php
namespace App\Services\Slide;
use App\Services\BaseService;
use App\Repositories\Slide\SlideRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;



class SlideService extends BaseService
{
    protected $slideRepository;
    public function __construct(
        SlideRepository $slideRepository
    ) {
        $this->slideRepository = $slideRepository;
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

    public function update($payload)
    {
        DB::beginTransaction();
        try {
            // Lấy danh sách các `collection_id` hiện tại trong hệ thống
            $existingSlides = $this->slideRepository->getAll(); // Giả sử bạn có một phương thức lấy tất cả slides
            $existingIds = $existingSlides->pluck('id')->toArray();

            $updatedIds = [];

            // Cập nhật các slide hiện có
            if (!empty($payload['collection_id']) && is_array($payload['collection_id'])) {
                foreach ($payload['collection_id'] as $key => $value) {
                    if (!is_numeric($key) || empty($value)) {
                        continue;
                    }
                    $this->slideRepository->update($key, ['collection_id' => $value]);
                    $updatedIds[] = $key; // Lưu lại các ID đã được cập nhật
                }
            }
            $idsToDelete = array_diff($existingIds, $updatedIds);
            // dd($idsToDelete);
            if (!empty($idsToDelete)) {
                foreach ($idsToDelete as $id) {
                    $this->slideRepository->delete($id);
                }
            }

            // Thêm mới các slide
            if (isset($payload['new_collection_id']) && is_array($payload['new_collection_id'])) {
                foreach ($payload['new_collection_id'] as $key => $value) {
                    if (empty($value)) {
                        continue;
                    }
                    $this->slideRepository->create(['collection_id' => $value]);
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $this->slideRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            // $this->log($e);
            // return false;
        }
    }


}