<?php
    $url = URL::route('api.store.forum');
?>
<div id="forum_create" style="display: none;" title="Create Forum">
    <form action="{{ $url }}" method="post">

        <label for="name">Name</label>
        <input class="form-control" type="text" id="name" />

        <label for="name">Description</label>
        <input class="form-control" type="text" id="description" />

        <label for="category">Category</label>
        <select class="form-control" id="category">
            @foreach($categories as $cat)
                {!! $cat->toOption() !!}
            @endforeach
        </select>

    </form>
</div>

<script>
    $(function() {
        var dialog, form,
                name = $( "#name" ),
                description = $( "#description" ),
                category_id = $( "#category" )
                allFields = $( [] ).add( name ),
                tips = $( ".validateTips" );

        function updateTips( t ) {
            tips
                    .text( t )
                    .addClass( "ui-state-highlight" );
            setTimeout(function() {
                tips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
        }

        function checkLength( o, n, min, max ) {
            if ( o.val().length > max || o.val().length < min ) {
                o.addClass( "ui-state-error" );
                updateTips( "Length of " + n + " must be between " +
                min + " and " + max + "." );
                return false;
            } else {
                return true;
            }
        }

        function checkRegexp( o, regexp, n ) {
            if ( !( regexp.test( o.val() ) ) ) {
                o.addClass( "ui-state-error" );
                updateTips( n );
                return false;
            } else {
                return true;
            }
        }

        function addForum() {
            var valid = true;
            allFields.removeClass( "ui-state-error" );

            valid = valid && checkLength( name, "name", 3, 25 );

            if ( valid ) {
                var aName = name.val();
                var aDesc = description.val();
                var aCat  = category_id.val();

                /* POST */
                jQuery.ajax({
                    url: "{{ $url }}",
                    type: "POST",
                    data: {
                        "name": aName,
                        "description": aDesc,
                        "category_id": aCat,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        window.location.reload();
                    },
                    error: function (response) {
                        console.log("failed");
                    }
                });
            }
            return valid;
        }

        dialog = $( "#forum_create" ).dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: true,
            buttons: {
                "Create": addForum,
                Cancel: function() {
                    dialog.dialog( "close" );
                }
            },
            close: function() {
                form[ 0 ].reset();
                allFields.removeClass( "ui-state-error" );
            }
        });

        form = dialog.find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            addForum();
        });

        $( "#createForum" ).button().on( "click", function() {
            dialog.dialog( "open" );
        });
    });
</script>