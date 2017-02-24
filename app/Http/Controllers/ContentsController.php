<?php

namespace App\Http\Controllers;

use App\Content;
use App\CustomOption;
use Illuminate\Http\Request;

class ContentsController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
{
    $content = CustomOption::findOrNew('main_page_content_block')->value;
    $title = CustomOption::find('main_page_product_block_title')->value;

    return view('contents.edit', compact('content','title'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $content = CustomOption::find('main_page_content_block');
        $content->update($request->only('value'));

        $title = CustomOption::find('main_page_product_block_title');
        $title->value = $request->get('title');
        $title->save();

        return redirect()->route('contents.edit');
    }

    public function editRefLink()
    {
        $content = CustomOption::findOrNew('referal_link_prefix')->value;

        return view('contents.edit_ref_link', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateRefLink(Request $request)
    {
        $content = CustomOption::find('referal_link_prefix');
        $content->update($request->only('value'));

        return redirect()->route('contents.editRefLink');
    }
}
