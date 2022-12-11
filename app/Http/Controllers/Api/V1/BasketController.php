<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Commands\AddToBasketCommand;
use App\Commands\RemoveFromBasketCommand;
use App\Handlers\AddToBasketHandler;
use App\Handlers\RemoveFromBasketHandler;
use App\Http\Controllers\Controller;
use App\Query\FindBasketQuery;
use App\Response\ApiV1Response;
use Illuminate\Support\Facades\Auth;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class BasketController extends Controller
{
    public function __construct(private readonly CommandBusInterface $commandBus)
    {
    }

    public function addToBasket($id)
    {
        try {
            $command = new AddToBasketCommand(intval($id), Auth::id());
            $this->commandBus->addHandler(AddToBasketCommand::class, AddToBasketHandler::class);
            $this->commandBus->dispatch($command);
            return ApiV1Response::success();
        } catch (\Exception $e) {
            return ApiV1Response::failed($e->getMessage());
        }
    }

    public function removeFromBasket($id)
    {
        try {
            $command = new RemoveFromBasketCommand(intval($id), Auth::id());
            $this->commandBus->addHandler(RemoveFromBasketCommand::class, RemoveFromBasketHandler::class);
            $this->commandBus->dispatch($command);
            return ApiV1Response::success();
        } catch (\Exception $e) {
            return ApiV1Response::failed($e->getMessage());
        }
    }

    public function getBasket()
    {
        try {
            return ApiV1Response::success((new FindBasketQuery())->find(Auth::id()));
        } catch (\Exception $e) {
            return ApiV1Response::failed($e->getMessage());
        }
    }
}
