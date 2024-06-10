<?php

namespace App\Repository\Eloquent;

use App\Models\Manager;
use App\Repository\ManagementRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ManagementRepository extends BaseRepository implements ManagementRepositoryInterface
{
    public function __construct(Manager $model)
    {
        parent::__construct($model);
    }


    public function create(array $attributes): Model
    {
        /** @var Manager $manager */
        $manager = $this->model->create($attributes);
        $this->handleMedia($manager, $attributes);

        return $manager;
    }

    public function update(int $id, array $data): bool
    {
        $manager = $this->find($id);
        $this->handleMedia($manager, $data);

        return $manager->update($data);
    }
}
