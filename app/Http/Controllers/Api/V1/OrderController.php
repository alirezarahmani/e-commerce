<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Commands\CancelOrderCommand;
use App\Commands\CreateOrderCommand;
use App\Commands\FinalizeOrderCommand;
use App\Handlers\CancelOrderHandler;
use App\Handlers\CreateOrderHandler;
use App\Handlers\FinalizeOrderHandler;
use App\Http\Controllers\Controller;
use App\Query\FindOrdersQuery;
use App\Requests\ApiV1Request;
use App\Response\ApiV1Response;
use App\ValueObjects\OrderStatus;
use Illuminate\Support\Facades\Auth;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class OrderController extends Controller
{
    public function __construct(private readonly CommandBusInterface $commandBus)
    {
    }

    public function index(ApiV1Request $request)
    {
        $query = new FindOrdersQuery();
        $result = $query->find(Auth::id(), OrderStatus::from($request->get('status', 0)));
        return ApiV1Response::success($result);
    }

    public function createOrder()
    {
        try {
            $command = new CreateOrderCommand(Auth::id());
            $this->commandBus->addHandler(CreateOrderCommand::class, CreateOrderHandler::class);
            $this->commandBus->dispatch($command);
            return ApiV1Response::success();
        } catch (\Exception $e) {
            return ApiV1Response::failed($e->getMessage());
        }
    }

    public function removeOrder($id)
    {
        try {
            $command = new CancelOrderCommand(Auth::id(), $id);
            $this->commandBus->addHandler(CancelOrderCommand::class, CancelOrderHandler::class);
            $this->commandBus->dispatch($command);
            return ApiV1Response::success();
        } catch (\Exception $e) {
            return ApiV1Response::failed($e->getMessage());
        }
    }

    public function finalizeOrder($id)
    {
        try {
            $command = new FinalizeOrderCommand(Auth::id(), $id);
            $this->commandBus->addHandler(FinalizeOrderCommand::class, FinalizeOrderHandler::class);
            $this->commandBus->dispatch($command);
            return ApiV1Response::success();
        } catch (\Exception $e) {
            return ApiV1Response::failed($e->getMessage());
        }
    }
}
