<?php

namespace App\Services;

use App\Models\Item;

class ItemService
{
    public function findByID(string $id)
    {
        return Item::findOrFail($id);
    }

    public function getAll()
    {
        return Item::all();
    }

    public function save(Array $item)
    {
        $item['valor_unitario'] = str_replace(['R$', '.', ','], ['', '', '.'], $item['valor_unitario']);

        $item = Item::create($item);

        return $item;
    }

    public function delete(string $id){
        $item = Item::findOrFail($id);
        $item->delete();

        return $item;
    }

    public function edit(Array $novoItem){
        $item = Item::findOrFail($novoItem['id']);
        $novoItem['valor_unitario'] = str_replace(['R$', '.', ','], ['', '', '.'], $novoItem['valor_unitario']);
        $item->update($novoItem);
        return $item;
    }
}
