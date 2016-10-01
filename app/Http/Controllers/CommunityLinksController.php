<?php

namespace App\Http\Controllers;

use App\Channel;
use App\CommunityLink;
use App\Http\Requests\CommunityLinkForm;
use App\Exceptions\CommunityLinkAlreadySubmitted;
use App\Queries\CommunityLinksQuery;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CommunityLinksController extends Controller
{
    public function index(Channel $channel = null)
    {
        $links = (new CommunityLinksQuery)->get(
            request()->exists('popular'), $channel
        );


        $channels = Channel::orderBy('title', 'asc')->get();

        return view('community.index', compact('links', 'channels', 'channel'));
    }

    /**
     * @param CommunityLinkForm $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommunityLinkForm $form)
    {
        try {

            $form->persist();

            if(auth()->user()->isTrusted()){
                flash('Thanks for the contribution', 'success');
            } else {
                flash()->overlay('Thanks', 'The contribution will be approved shortly');
            }

        } catch(CommunityLinkAlreadySubmitted $e){

            flash()->overlay(
                "We'll instead bump the timestamps and bring that link back to the top. Thanks!",
                'That link Has Already Been Submitted'
            );
        }

        return back();
    }
}
