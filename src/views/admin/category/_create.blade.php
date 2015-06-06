<div id="category_create" style="display: none;" title="Create Category">
    <form action="{{ URL::route('api.store.forum.category') }}" method="post">

        <label for="name">Name</label>
        <input type="text" id="name" />

    </form>
</div>

<script>
    $(function() {
        var dialog, form,
                name = $( "#name" ),
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

        function addCategory() {
            var valid = true;
            allFields.removeClass( "ui-state-error" );

            valid = valid && checkLength( name, "name", 3, 25 );

            if ( valid ) {
                var aName = name.val();

                /* POST */
                jQuery.ajax({
                    url: "{{ URL::route('api.store.forum.category') }}",
                    type: "POST",
                    data: {
                        "name": aName,
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

        dialog = $( "#category_create" ).dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: true,
            buttons: {
                "Create": addCategory,
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
            addCategory();
        });

        $( "#createCategory" ).button().on( "click", function() {
            dialog.dialog( "open" );
        });
    });
</script>