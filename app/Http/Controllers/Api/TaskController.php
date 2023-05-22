<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Requests\TaskUpdateStatusRequest;
use App\Repositories\TaskRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * @var TaskRepository
     */
    protected TaskRepository $task;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->task = $taskRepository;
    }

    public function getList(): JsonResponse
    {
        try {
            $data = $this->task->getList();
            return $this->response200($data);
        } catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
    }

    public function create(TaskRequest $request): JsonResponse
    {
        // co the luu theo channel
        Log::info(json_encode($request->all()));
        try {
            DB::beginTransaction();
            $result = $this->task->create($request);
            DB::commit();
            return $this->response200($result);
        } catch (\Exception $exception) {
            DB::commit();
            return $this->response500($exception->getMessage());
        }
    }

    public function update(TaskUpdateRequest $request, int $id): JsonResponse
    {
        // co the luu theo channel
        Log::info(json_encode($request->all()));
        try {
            if (! $this->task->checkExists($id)) {
                return $this->response400('Id is not Exists');
            }

            DB::beginTransaction();
            $this->task->update($request->validated(), $id);
            DB::commit();
            return $this->response200();
        } catch (\Exception $exception) {
            DB::commit();
            return $this->response500($exception->getMessage());
        }
    }

    public function updateStatus(TaskUpdateStatusRequest $request, int $id): JsonResponse
    {
        try {
            if (! $this->task->checkExists($id)) {
                return $this->response400('Id is not Exists');
            }

            DB::beginTransaction();
            $this->task->update($request->validated(), $id);
            DB::commit();
            return $this->response200();
        } catch (\Exception $exception) {
            DB::commit();
            return $this->response500($exception->getMessage());
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            if (! $this->task->checkExists($id)) {
                return $this->response400('Id is not Exists');
            }

            DB::beginTransaction();
            $this->task->delete($id);
            DB::commit();
            return $this->response200();
        } catch (\Exception $exception) {
            DB::commit();
            return $this->response500($exception->getMessage());
        }
    }
}
