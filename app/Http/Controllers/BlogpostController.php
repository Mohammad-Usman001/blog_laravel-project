<?php

namespace App\Http\Controllers;

use App\Models\Blogpost;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class BlogpostController extends Controller
{
    public function index(Request $request)
    {
        // $blogposts = Blogpost::with('category')->get();
        $query = Blogpost::with('category');

        if ($request->ajax()) {
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhereHas('category', fn($q2) => $q2->where('name', 'like', "%{$search}%"));


                    // Flexible date handling
                    $parts = explode('-', $search);

                    if (count($parts) === 1 && is_numeric($parts[0])) {
                        // Only day
                        $day = (int)$parts[0];
                        $q->orWhereDay('created_at', $day);
                    } elseif (count($parts) === 2 && is_numeric($parts[0]) && is_numeric($parts[1])) {
                        // Day and month
                        $day = (int)$parts[0];
                        $month = (int)$parts[1];
                        $q->orWhere(function ($query) use ($day, $month) {
                            $query->whereDay('created_at', $day)
                                ->whereMonth('created_at', $month);
                        });
                    } elseif (count($parts) === 3) {
                        // Full date
                        try {
                            $date = Carbon::createFromFormat('d-m-Y', $search)->format('Y-m-d');
                            $q->orWhereDate('created_at', $date);
                        } catch (\Exception $e) {
                            // Invalid date, skip
                        }
                    }
                });
            }


            $blogposts = $query->orderBy('created_at', 'desc')->paginate(15);
            return view('Blogpost.partials.table', compact('blogposts'))->render();
        }

        $blogposts = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('Blogpost.index', compact('blogposts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Blogpost.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|min:10|max:255',
            'slug' => 'required|string|min:10|max:255|unique:blogposts,slug',
            'short_description' => 'required|string|min:10',
            'meta_title' => 'string|min:10|max:255|nullable',
            'meta_description' => 'nullable|string|min:10',
            'content' => 'required|min:50|string',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:3000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $imagePath = $request->file('image')->store('BlogImage', 'public');
                $data['image'] = $imagePath;
            } else {
                return redirect()->back()->withErrors(['image' => 'Uploaded image is not valid.'])->withInput();
            }
        }
        Blogpost::create($data);
        return redirect()->route('blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $blogpost = Blogpost::findOrFail($id);
        return view('Blogpost.edit', compact('blogpost', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|min:10|max:255',
            'slug' => 'required|string|min:10|max:255|unique:blogposts,slug,' . $id,
            'short_description' => 'required|string|min:10',
            'meta_title' => 'string|min:10|max:255|nullable',
            'meta_description' => 'nullable|string|min:10',
            'content' => 'required|min:50|string',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:3000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $imagePath = $request->file('image')->store('BlogImage', 'public');
                $data['image'] = $imagePath;
            } else {
                return redirect()->back()->withErrors(['image' => 'Uploaded image is not valid.'])->withInput();
            }
        }
        $blogpost = Blogpost::findOrFail($id);
        $blogpost->update($data);
        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');
    }
}
