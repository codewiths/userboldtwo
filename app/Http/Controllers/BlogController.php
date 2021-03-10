<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('tables.datatables',compact('blogs'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tables.create');
    }
  
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
  
        Blog::create($request->all());
   
        return redirect()->route('datatables')
                        ->with('success','Blog created successfully.');
    }
   
    public function show(Blog $blog)
    {
        return view('tables.show',compact('blog'));
    }
   
    public function edit(Blog $blog)
    {
        return view('tables.edit',compact('blog'));
    }
  
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
  
        $blog->update($request->all());
  
        return redirect()->route('datatables')
                        ->with('success','Blog updated successfully');
    }
  
    public function destroy(Blog $blog)
    {
        $blog->delete();
  
        return redirect()->route('datatables')
                        ->with('success','Blogs deleted successfully');
    }
}