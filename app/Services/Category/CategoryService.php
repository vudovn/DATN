<?php

namespace App\Services\Category;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Category\CategoryRepository;



class CategoryService extends BaseService
{

    protected $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }


    private function paginateAgrument($request)
    {
        return [
            'keyword' => [
                'search' => $request->input('keyword'),
                'field' => ['name']
            ],
            'condition' => [
                'publish' => $request->integer('publish'),
                // 'user_catalogue_id' => $request->integer('user_catalogue_id'),
            ],
            'sort' => $request->input('sort')
                ? array_map('trim', explode(',', $request->input('sort')))
                : ['id', 'asc'],
            'perpage' => $request->integer('perpage') ?? 20,
        ];
    }

    public function paginate($request)
    {
        $agruments = $this->paginateAgrument($request);
        $cacheKey = 'pagination: ' . md5(json_encode($agruments));
        $categories = $this->categoryRepository->pagination($agruments);
        return $categories;
    }


    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token']);
            $payload['slug'] = getSlug($payload['name']);
            $category = $this->categoryRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            // echo $e->getMessage();die(); 
            $this->log($e);
            return false;
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', '_method']);
            $payload['slug'] = getSlug($payload['name']);
            $category = $this->categoryRepository->update($id, $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            // echo $e->getMessage();die();
            $this->log($e);
            return false;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->findById($id);
            // dd($category->children()->count() );
            if ($category->children()->count() == 0) {
                $this->categoryRepository->delete($id);
                DB::commit();
                return true;
            }
        } catch (\Exception $e) {
            DB::rollback();
            // echo $e->getMessage();die();
            $this->log($e);
            return false;
        }
    }
    public function renderCategoryOptions($categories, $level = 0)
    {
        $html = '';
        foreach ($categories as $category) {
            $indent = str_repeat('&nbsp;', $level * 4);
            $html .= '<option value="' . $category->id . '">' . $indent . $category->name . '</option>';
            if ($category->children->isNotEmpty()) {
                $html .= $this->renderCategoryOptions($category->children, $level + 1);
            }
        }
        return $html;
    }
}
