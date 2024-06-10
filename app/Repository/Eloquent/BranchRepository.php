<?php

namespace App\Repository\Eloquent;

use App\Models\Branch;
use App\Repository\BranchRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BranchRepository extends BaseRepository implements BranchRepositoryInterface
{

    public function __construct(Branch $model)
    {
        parent::__construct($model);
    }


    public function create(array $attributes): Model
    {
        $category = $this->model->create($attributes);
        $this->handleMedia($category, $attributes);

        return $category;
    }

    public function update(int $id, array $data): bool
    {
        $category = $this->find($id);
        $result = $category->update($data);
        $this->handleMedia($category, $data);

        return $result;
    }
}
