<?php

namespace App\Services;

use App\Models\Category;
use App\Models\City;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $data
     * @return Category
     */
    public function createCategory(array $data): Category
    {
        $category = $this->categoryRepository->createCategory($data);
        $this->categoryRepository->saveTranslations($category, $data['translations'] ?? []);

        return $category;
    }

    /**
     * @param string $id
     * @param array $data
     * @return Category
     * @throws Exception
     */
    public function updateCategory(string $id, array $data): Category
    {
        $category = $this->categoryRepository->findCategoryById($id);
        if (!$category) {
            throw new Exception('City not found');
        }

        $this->categoryRepository->updateCategory($category, $data);
        $this->categoryRepository->saveTranslations($category, $data['translations'] ?? []);

        return $this->categoryRepository->findCategoryById($id);
    }

    /**
     * @param string $id
     * @return void
     */
    public function deleteCategory(string $id): void
    {
        $category = $this->categoryRepository->findCategoryById($id);

        $this->categoryRepository->deleteCategory($category);
    }

    public function findCategoryById(string $id): ?Category
    {
        return $this->categoryRepository->findCategoryById($id);
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllCategories(array $filters = []): LengthAwarePaginator
    {
        return $this->categoryRepository->getAllCategories($filters);
    }

}
