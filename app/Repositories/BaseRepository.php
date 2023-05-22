<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $model;

    /**
     * @param array $data
     */
    public function insert(array $data)
    {
        return $this->model->create($data);
    }

    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * @param array $data
     * @param integer $id
     */
    public function updateById(array $data, int $id)
    {
        return $this->model->whereKey($id)->update($data);
    }

    /**
     * @param integer $id
     */
    public function deleteById(int $id)
    {
        return $this->model->whereKey($id)->delete();
    }
}
