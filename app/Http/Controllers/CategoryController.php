<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('type', '1')->orderBy('created_at', 'DESC')->get();
        return view('pages.category.category', ['categories' => $categories]);
    }

    public function motorindex()
    {
        $categories = Category::where('type', '2')->orderBy('created_at', 'DESC')->get();
        return view('pages.category.categorymotor', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'type' => '1',
        ]);
        return redirect()->back()->with('success', 'Category successfully added');
    }

    public function storemotor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'type' => '2',
        ]);
        return redirect()->back()->with('success', 'Category successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories = Category::where('slug', $slug)->first();
        return view('pages.category.edit', ['categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
        
        $categories = Category::where('slug', $slug)->first();
        $categories->slug = null;
        $categories->update($request->all());
        return redirect()->back()->with('success', 'Category successfully changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $categories = Category::where('slug', $slug)->first();
        $categories->delete();
        return redirect()->back()->with('success', 'Category successfully deleted');
    }
}
