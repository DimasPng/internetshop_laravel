<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class DestroyController extends Controller
{
    public function __invoke(Category $category)
    {
        Storage::disk('public')->delete($category->image);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
