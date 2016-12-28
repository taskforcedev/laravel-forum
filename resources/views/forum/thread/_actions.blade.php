@if ( isset($user) && isset($isAdmin) && $isAdmin === true )
    <script type="application/javascript">
        var data = {
            "sticky_url": "{{ route('laravel-forum.api.post.sticky', $post->id) }}",
            "unsticky_url": "{{ route('laravel-forum.api.post.unsticky', $post->id) }}",
            "lock_url": "{{ route('laravel-forum.api.post.lock', $post->id) }}",
            "unlock_url": "{{ route('laravel-forum.api.post.unlock', $post->id) }}",
            "delete_url": "{{ route('laravel-forum.api.delete.forum.post', [ $forum->id, $post->id ]) }}",
        }

        var postdata = {
            "_token": "{{ csrf_token() }}"
        }

        function stickyPost()
        {
            $.post( data.sticky_url, postdata)
                .done(function() {
                    window.location.reload();
                });
        }

        function unstickyPost()
        {
            $.post( data.unsticky_url, postdata)
                .done(function() {
                    window.location.reload();
                });
        }

        function lockPost()
        {
            $.post( data.lock_url, postdata)
                    .done(function() {
                        window.location.reload();
                    });
        }

        function unlockPost()
        {
            $.post( data.unlock_url, postdata)
                .done(function() {
                    window.location.reload();
                });
        }

        function deletePost()
        {
            $confirm = confirm('Are you sure you wish to delete this thread? This cannot be undone.');
            var postdata = {
                "_method": "DELETE",
                "_token": "{{ csrf_token() }}"
            }

            if ($confirm) {
                $.post( data.delete_url, postdata)
                    .done(function() {
                        window.location = "{{ route('laravel-forum.view', $forum->id) }}";
                    });
            }
        }
    </script>
    <span class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-danger">Actions</button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    @if ($sticky)
                        <li><a onclick="return unstickyPost();"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span> Unsticky</a></li>
                    @else
                        <li><a onclick="return stickyPost();"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span> Sticky</a></li>
                    @endif
                    <li role="separator" class="divider"></li>
                    @if ($locked)
                        <li><a onclick="return unlockPost();"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Unlock</a></li>
                    @else
                        <li><a onclick="return lockPost();"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Lock</a></li>
                    @endif
                    <li role="separator" class="divider"></li>
                    <li><a onclick="return deletePost();"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</a></li>
                </ul>
            </div>
        </span>
@endif
