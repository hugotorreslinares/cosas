<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Inertia\Inertia;
use Inertia\Response;

class ItemController extends Controller
{
    public function index(): Response
    {
        $this->authorize('viewAny', Item::class);

        $items = Item::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return Inertia::render('Items/Index', [
            'items' => $items,
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Item::class);

        return Inertia::render('Items/Create');
    }

    public function store(StoreItemRequest $request)
    {
        $this->authorize('create', Item::class);

        Item::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
            'is_published' => false,
        ]);

        return redirect()->route('items.index');
    }

    public function edit(Item $item): Response
    {
        $this->authorize('update', $item);

        return Inertia::render('Items/Edit', [
            'item' => $item,
        ]);
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->validated());

        return redirect()->route('items.index');
    }

    public function publish(Item $item)
    {
        $this->authorize('update', $item);

        $item->update([
            'is_published' => true,
        ]);

        return redirect()->route('items.index');
    }

    public function unpublish(Item $item)
    {
        $this->authorize('update', $item);

        $item->update([
            'is_published' => false,
        ]);

        return redirect()->route('items.index');
    }
}
