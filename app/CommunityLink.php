<?php

namespace App;

use App\User;
use App\Channel;
use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{

    protected $fillable = [
        'channel_id', 'title', 'link'
    ];


    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function from(User $user)
    {
        $link = new static;

        $link->user_id = $user->id;

        if($user->isTrusted()){
            $link->approve();
        }
        

        return $link;
    }

    public function contribute($attributes)
    {
        $this->fill($attributes)->save();
    }

    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public function approve()
    {
        $this->approved = true;

        return $this;
    }
}
