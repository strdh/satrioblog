<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Management\CategoryRequest;
use App\Models\Category;
use Facades\App\Repositories\Management\CategoryRepository;

class CategoryController extends Controller
{
    public function index()
    {
        return view('management.category.index');
    }

    public function categoryTable()
    {
        return CategoryRepository::getCategory();
    }

    public function create()
    {
        return view('management.category.create');
    }

    public function store(CategoryRequest $request)
    {
        CategoryRepository::store($request);
        return redirect(route('management.category.create'))->with('success', 'Data berhasil disimpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::FindOrFail($id);
        return view('management.category.edit', ['category' => $category]);
    }

    public function update(CategoryRequest $request, $id)
    {
        CategoryRepository::update($request, $id);
        return redirect(route('management.category.index'))->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        if (CategoryRepository::del($id)) {
            return redirect(route('management.category.index'))->with('warning', 'Data telah dihapus');
        } else {
            return redirect(route('management.category.index'))->with('error', 'Gagal dihapus');
        }
    }
}
