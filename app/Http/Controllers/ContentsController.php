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

        return view('contents.edit', compact('content'));
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

        return redirect()->route('contents.edit');
    }
}
