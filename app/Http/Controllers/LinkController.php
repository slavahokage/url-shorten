<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function createShortLink()
    {
        return view('create-short-link');
    }

    public function showLinkInfo($id)
    {
        $link = Link::findOrFail($id);

        return view('show-link-info')->with('link', $link);
    }

    public function redirectToOriginalLink($id)
    {
        $link = Link::findOrFail(base64_decode($id));

        return redirect($link->original_link);
    }

    public function handleNewLink(Request $request)
    {
        $link = Link::firstOrCreate(['original_link' => $request->input('original_link')]);

        $request->session()->flash('message', 'Successfully create');

        return redirect()->route('create-short-link')->with('shortLink', $link->short_link);
    }
}
