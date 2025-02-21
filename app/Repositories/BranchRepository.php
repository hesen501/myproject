<?php

namespace App\Repositories;

use App\Models\Branch;
use App\Repositories\Interfaces\BranchRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BranchRepository implements BranchRepositoryInterface
{
    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllBranches(array $filters = []): LengthAwarePaginator
    {
        $query = Branch::query();

        if (!empty($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (isset($filters['delivery_status'])) {
            $query->where('delivery_status', $filters['delivery_status']);
        }

        return $query->paginate(10);
    }

    /**
     * @param string $id
     * @return Branch|null
     */
    public function findBranchById(string $id): ?Branch
    {
        return Branch::findOrFail($id);
    }

    /**
     * @param array $data
     * @return Branch
     */
    public function createBranch(array $data): Branch
    {
        return Branch::create($data);
    }

    /**
     * @param Branch $branch
     * @param array $data
     * @return Branch
     */
    public function updateBranch(Branch $branch, array $data): Branch
    {
        $branch->update($data);
        return $branch;
    }

    /**
     * @param Branch $branch
     * @return void
     */
    public function deleteBranch(Branch $branch): void
    {
        $branch->delete();
    }
}
