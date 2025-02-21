<?php

namespace App\Repositories\Interfaces;

use App\Models\Branch;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BranchRepositoryInterface
{
    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllBranches(array $filters = []): LengthAwarePaginator;

    /**
     * @param string $id
     * @return Branch|null
     */
    public function findBranchById(string $id): ?Branch;


    /**
     * @param array $data
     * @return Branch
     */
    public function createBranch(array $data): Branch;

    /**
     * @param Branch $branch
     * @param array $data
     * @return Branch
     */
    public function updateBranch(Branch $branch, array $data): Branch;

    /**
     * @param Branch $branch
     * @return void
     */
    public function deleteBranch(Branch $branch): void;
}
