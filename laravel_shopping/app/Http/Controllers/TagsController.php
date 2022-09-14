<?php

namespace App\Http\Controllers;

use App\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tags::orderByDesc('id')->paginate(5);

        return view('admin.tags.tags_list', compact('tags'));
    }

    public function create()
    {

        return view('admin.tags.tags_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $tags = new Tags();
        $tags->name = $request->name;

        $tags->save();

        return redirect()->route('tags.list')->with('success', 'Tags sản phẩm đã được thêm thành công');
    }

    public function edit($id)
    {
        $tags = Tags::find($id);

        return view('admin.tags.tags_edit', compact('tags'));

    }

    public function update(Request $request, $id)
    {

        $tags = Tags::find($id);
        $tags->name = $request->name;

        $tags->save();

        return redirect()->route('tags.list')->with('success', 'Tags sản phẩm đã được cập nhật thành công');

    }

    public function delete($id)
    {
        Tags::find($id)->delete();

        return redirect()->back()->with('success', 'Tags sản phẩm đã được xóa thành công');
    }
}
