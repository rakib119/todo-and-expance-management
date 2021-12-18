<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('Category.index', [
            'categories' => Category::all(),
            'total_category' => DB::table('categories')->count(),


        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $created_by = auth()->id();
        $created_at = Carbon::now();

        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'created_by' => auth()->id(),
            'created_at' => Carbon::now()
        ]);
        return redirect('category')->with('success', 'category successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("Category.edit", [
            'category_details' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);
        // $category->updated([
        //     'category_name'=>$request->category_name
        // ]);
        $category->category_name = $request->category_name;
        $category->save();
        return redirect('category')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', "category deleted successfully");
    }
    public function statusUpdate($id)
    {
        $category =  Category::find($id);
        if ($category->status == 1) {
            $category->status = 0;
            $category->save();
        } else {
            $category->status = 1;
            $category->save();
        }
        return back()->with('Category status successfully updated');
    }
}
