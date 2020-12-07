<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContentRequest;
use App\Menu;
use App\Content;
use Session;

class ContentController extends MainController
{
    public function index()
    {
        self::$viewData['contents']  = Content::all()->toArray();
       return view('cms.content.content_index', self::$viewData);
    }

    public function create()
    {
        return view('cms.content.content_add', self::$viewData);
    }

    public function store(ContentRequest $request)
    {
        Content::save_new($request);
        return redirect('cms/content');
    }

    public function show($id)
    {
        self::$viewData['item_id'] = $id;
        return view('cms.content.content_delete', self::$viewData);
    }

    public function edit($id)
    {
        self::$viewData['content'] = Content::find($id)->toArray();
        return view('cms.content.content_edit', self::$viewData);
    }

    public function update(ContentRequest $request, $id)
    {
       Content::update_item($request, $id);
       return redirect('cms/content');  
    }

    public function destroy($id)
    {
        Content::destroy($id);
        Session::flash('sm', 'Content has been deleted!');
        return redirect('cms.content.content');
    }
}
