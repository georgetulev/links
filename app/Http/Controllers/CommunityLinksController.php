<?php

namespace App\Http\Controllers;

use App\Channel;
use App\CommunityLink;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CommunityLinksController extends Controller
{
    public function index()
    {
        $links = CommunityLink::where('approved', 1)->paginate(25);
        $channels = Channel::orderBy('title', 'asc')->get();

        return view('community.index', compact('links', 'channels'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'channel_id' => 'required',
            'title' => 'required',
            'link'  => 'required|active_url|unique:community_links'
        ]);

        CommunityLink::from(auth()->user())
            ->contribute($request->all());

        if(auth()->user()->isTrusted()) {
            flash('Thanks for the contribution!');
        } else {
            falsh('This contribution will be approved shortly', 'Thanks');
        }

        return back();
    }
}
