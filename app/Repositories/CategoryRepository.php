<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository
{
    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllCategories(array $filters = []): LengthAwarePaginator
    {
        $query = Category::with([
            'translations' => function ($query)  {
                $query->select('category_id', 'locale', 'title');
            },
            'children' => function ($query) {
                $query->select('id', 'parent_id', 'slug')
                    ->selectSub(function ($subQuery) {
                        $subQuery->select('title')
                            ->from('category_translations')
                            ->whereColumn('category_translations.category_id', 'categories.id')
                            ->where('locale', 'en')
                            ->limit(1);
                    }, 'title');
                }
        ]);

        if (!empty($filters['title']) && strlen($filters['title']) > 0) {
            $query->whereHas('translations', function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['title'] . '%');
            });
        }

        return $query->paginate(10);
    }

    /**
     * @param string $id
     * @return Category|null
     */
    public function findCategoryById(string $id): ?Category
    {
        return Category::with([
            'translations' => function ($query)  {
                $query->select('category_id', 'locale', 'title');
            },
            'children' => function($query) {
                $query->select('id','parent_id', 'slug')
                    ->with([
                        'translations' => function ($query)  {
                            $query->select('category_id', 'locale', 'title')->where('locale', 'en');
                        }
                    ]);
            },
        ])->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Category
     */
    public function createCategory(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * @param Category $category
     * @param array $data
     * @return Category
     */
    public function updateCategory(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    /**
     * @param Category $category
     * @return void
     */
    public function deleteCategory(Category $category): void
    {
        $category->delete();
    }


    /**
     * @param Category $category
     * @param array $translations
     * @return void
     */
    public function saveTranslations(Category $category, array $translations): void
    {
        foreach ($translations as $locale => $title) {
            if (!$title)
                continue;
            $category->translations()->updateOrCreate(
                ['locale' => $locale],
                ['title' => $title]
            );
        }
    }
}
