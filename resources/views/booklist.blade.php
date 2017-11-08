<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
</head>
    <body>
    <div class="container">
        {{--Header Started--}}

        <div class="btn btn-block"><a href="{{ route('book.create')  }}"><h2>Add New Book</h2></a></div>

        <table id="livros_table" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Author Name</th>
              </tr>
            </thead>
            <tbody>
                @yield('table-contents')
            </tbody>
        </table>

        {{--Footer Finished--}}
    </div>
    <script
			  src="https://code.jquery.com/jquery-2.2.4.min.js"
			  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
			  crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script>
    function deleteBook(e){
      console.log(e.id);
      console.log(e.offsetParent.offsetParent.offsetParent);
    }
      jQuery(document).ready(function(){

        function format ( d ) {
            console.log(d);
            // `d` is the original data object for the row
            var returnLayout =  '<form style="margin:0px;" method="POST" action="{{url('book')}}/'+d.id+'"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input name="_method" value="DELETE" type="hidden">'+
                                  '<input class="btn btn-default col-xs-2" value="Delete" type="submit">'+
                                '</form>'+
                    '<div><a class="btn btn-default col-xs-2" href="{{url('book')}}/'+d.id+'/edit">Edit</a></div>';
            return returnLayout;
        }

        $('.deleteBook').click(function(e){
          console.log('ok');
          console.log(e);
        });

        var concorrente_data_table = $('#livros_table').DataTable({
          "ajax": "{{url('api/v1/book')}}?api_token={{Auth::user()->api_token}}",
          "columns": [
              {
                  "className":      'details-control',
                  "orderable":      false,
                  "data":           null,
                  "defaultContent": ''
              },
              { "data": "id"},
              { "data": "title"},
              { "data": "description"},
              { "data": "author"}
          ],
          "order": [[1, 'asc']]
        });

        $('#livros_table tbody').on('click', 'td.details-control', function () {
              var tr = $(this).closest('tr');
              var row = concorrente_data_table.row( tr );

              if ( row.child.isShown() ) {
                  // This row is already open - close it
                  row.child.hide();
                  tr.removeClass('shown');
              }
              else {
                  // Open this row
                  row.child( format(row.data()) ).show();
                  tr.addClass('shown');
              }
          } );

          $( ".deleteBook" ).on("click", function() {
            console.log( $( this ).text() );
          });
      });
    </script>
    </body>
</html>
