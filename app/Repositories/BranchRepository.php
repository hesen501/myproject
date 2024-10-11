<?php

namespace App\Repositories;

use App\Models\Branch;

class BranchRepository
{
    public function getAllBranches(array $filters = [])
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

    public function findBranchById(string $id): ?Branch
    {
        return Branch::find($id);
    }

    public function createBranch(array $data): Branch
    {
        return Branch::create($data);
    }

    public function updateBranch(Branch $branch, array $data): Branch
    {
        $branch->update($data);
        return $branch;
    }

    public function deleteBranch(Branch $branch): void
    {
        $branch->delete();
    }
}
