@if(Auth::check())
<div class="col-md-4">
    <h3>CONTRIBUTE LINK</h3>
    <hr>
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="POST" action="/community">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('channel_id') ? 'has-error' : '' }}">
                    <label for="Channel">Channel</label>
                    <select class="form-control" name="channel_id">
                            <option selected disabled>Pick a channel...</option>
                        @foreach($channels as $channel)
                            <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                {{ $channel->title }}
                            </option>
                        @endforeach
                    </select>

                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                </div>

                <div class="form-group  {{ $errors->has('title') ? 'has_error' : '' }}">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" value="{{ old('title') }}" id="title" name="title" placeholder="What is the title for your article?" required>
                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                </div>

                <div class="form-group {{ $errors->has('link') ? 'has_error' : '' }}">
                    <label for="link">Link:</label>
                    <input type="text" class="form-control" value="{{ old('link') }}" id="link" name="link" placeholder="What is the URL?" required>
                    {!! $errors->first('link', '<span class="help-block">:message</span>') !!}
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Contribute Link</button>
                </div>

            </form>
        </div>
    </div>
</div>
@else
    <h3>Please sign in ...</h3>
@endif