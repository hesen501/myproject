<?php

namespace App\Services;

use App\Models\Branch;
use App\Repositories\BranchRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BranchService
{
    private BranchRepository $branchRepository;

    public function __construct(BranchRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    public function createBranch(array $data): Branch
    {
        return $this->branchRepository->createBranch($data);
    }

    public function updateBranch(string $id, array $data): Branch
    {
        $branch = $this->branchRepository->findBranchById($id);

        return $this->branchRepository->updateBranch($branch, $data);
    }

    public function deleteBranch(string $id): void
    {
        $branch = $this->branchRepository->findBranchById($id);

        $this->branchRepository->deleteBranch($branch);
    }

    public function findBranchById(string $id): ?Branch
    {
        return $this->branchRepository->findBranchById($id);
    }

    public function getAllBranches(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->branchRepository->getAllBranches($filters);
    }
}
