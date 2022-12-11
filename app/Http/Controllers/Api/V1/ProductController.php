<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Commands\CreateProductCommand;
use App\Commands\ImportProductCommand;
use App\Commands\RemoveProductCommand;
use App\Commands\UpdateProductCommand;
use App\Handlers\CreateProductHandler;
use App\Handlers\ImportProductHandler;
use App\Handlers\RemoveProductHandler;
use App\Handlers\UpdateProductHandler;
use App\Http\Controllers\Controller;
use App\Query\FindProductsQuery;
use App\Query\FindSingleProductQuery;
use App\Requests\ApiV1Request;
use App\Response\ApiV1Response;
use Illuminate\Http\Request;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class ProductController extends Controller
{
    public function __construct(private readonly CommandBusInterface $commandBus)
    {
    }

    public function index()
    {
        try {
            $query = new FindProductsQuery();
            return $query->find();
        } catch (\Error $e) {
            return ApiV1Response::failed($e->getMessage());
        }
    }

    public function store($id, ApiV1Request $request)
    {
        try {
            $command = new CreateProductCommand(
                $request->get('name'),
                $request->get('price'),
                $request->get('stock'),
                intval($id)
            );
            $this->commandBus->addHandler(CreateProductCommand::class, CreateProductHandler::class);
            $this->commandBus->dispatch($command);
            return ApiV1Response::success();
        } catch (\Error $e) {
            return ApiV1Response::failed($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $product = new FindSingleProductQuery();
            return ApiV1Response::success($product->find($id));
        } catch (\Error $e) {
            return ApiV1Response::failed($e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try {
            $command = new UpdateProductCommand(
                intval($id),
                $request->get('name'),
                $request->get('price'),
                $request->get('stock'),
                $request->get('brand_id'),
            );
            $this->commandBus->addHandler(UpdateProductCommand::class, UpdateProductHandler::class);
            $this->commandBus->dispatch($command);

            return ApiV1Response::success();
        } catch (\Error $e) {
            return ApiV1Response::failed($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $command = new RemoveProductCommand(intval($id));
            $this->commandBus->addHandler(RemoveProductCommand::class, RemoveProductHandler::class);
            $this->commandBus->dispatch($command);
            return ApiV1Response::success();
        } catch (\Error $e) {
            return ApiV1Response::failed($e->getMessage());
        }
    }

    public function csvImport(ApiV1Request $request)
    {
        try {
            $command = new ImportProductCommand($request->file('file')->store('temp'));
            $this->commandBus->addHandler(ImportProductCommand::class, ImportProductHandler::class);
            $this->commandBus->dispatch($command);
            return ApiV1Response::success();
        } catch (\Error $e) {
            return ApiV1Response::failed($e->getMessage());
        }
    }
}
