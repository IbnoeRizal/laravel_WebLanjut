<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $categories = Category::all();
      return view('components.form',["event" => "indexCateg", "message" => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        Category::create([
            'nama' => $request->nama,
        ]);

        return back()->with('success', 'kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = (int) $id;
        $category = Category::findOrFail($id);
        return view('components.form', ['event' => 'showCateg', 'message' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $category = Category::all();
        return view('components.form',['event' => 'editCateg', 'message' => $category]);
    }

    public function create()
    {
        return view('components.form',['event' => 'createCateg', 'message' => null]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = (int) $id;
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);
        $category = Category::findOrFail($id);
        $category->update([
            'nama' => $request->nama,
        ]);
        return back()->with('success', 'kategori berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = (int) $id;
        $category = Category::findOrFail($id);
        $category->delete();
        return back()->with('success', 'kategori berhasil dihapus');
    }
}
