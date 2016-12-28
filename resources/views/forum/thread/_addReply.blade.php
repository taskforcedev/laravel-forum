@if (\Auth::check())
    <form method="POST" action="{{ route('laravel-forum.api.store.forum.reply') }}">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Reply</h2>

        <textarea name="body" class="form-control wysiwyg"></textarea>

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="forum_id" value="{{ $forum->id }}" />
        <input type="hidden" name="post_id" value="{{ $post->id }}" />

        <input class="btn btn-primary" type="submit" value="Reply" />
    </div>
    </form>
@endif
