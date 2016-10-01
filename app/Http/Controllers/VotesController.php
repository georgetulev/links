<?php

namespace App\Http\Controllers;

use App\CommunityLink;


class VotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @param CommunityLink $link
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommunityLink $link)
    {
       // CommunityLinkVote::firstOrNew([
       //     'user_id' => auth()->id(),
       //     'community_link_id' => $link->id
       // ])->toggle();

        $user = auth()->user();

        if($user->votedFor($link)){
            $user->unvoteFor($link);
        } else {
            $user->voteFor($link);
        }

        return back();
    }
}
