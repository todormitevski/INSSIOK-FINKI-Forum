<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Post;
use App\Models\Subject;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->input('q');

        $majors = Major::where('name', 'like', "%$q%")->limit(5)->get();
        $posts = Post::where('title', 'like', "%$q%")->limit(5)->get();
        $subjects = Subject::where('name', 'like', "%$q%")->limit(5)->get();

        return view('search.search', compact('q', 'majors', 'posts', 'subjects'));
    }

}
