<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Category $category)
    {
        $data = request()->all();
        Category::validation($data);
        Category::create($data);
        return back()->with('notification', 'La categoria de ha creado exitosamente');
    }

    public function update(Category $category)
    {
        $data = request()->all();
        Category::validation($data);
        $category = Category::find($data['category_id']);
        $category->update($data);
        return back()->with('notification', 'La categoria se editó  exitosamente');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return back()->with('notification', 'La categoria se eliminó  exitosamente');
    }
}
