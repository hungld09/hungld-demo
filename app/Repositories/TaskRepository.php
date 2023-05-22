<?php

namespace App\Repositories;


use App\Models\Task;
use Illuminate\Http\Request;

class TaskRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Task();
    }

    public function getList()
    {
        return $this->findAll();
    }

    public function create(Request $request)
    {
        return $this->insert($request->all());
    }

    /**
     * @param array $data
     */
    public function update(array $data, $id)
    {
        return $this->updateById($data, $id);
    }

    /**
     * @param integer $id
     */
    public function checkExists(int $id)
    {
        return $this->checkExistsById($id);
    }

    /**
     * @param integer $id
     */
    public function delete(int $id)
    {
        return $this->deleteById($id);
    }
}
