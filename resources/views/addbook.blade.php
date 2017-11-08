<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        {{--Header Finished--}}

        <div><h1>Add New Book</h1></div>
        {!! Form::open(['action' => 'BookController@create']) !!}

            <div class="form-group">
                {!! Form::label('title', 'Title :') !!}
                {!! Form::text('title', null, ['id'=>'title', 'class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description :') !!}
                {!! Form::textarea('description', null,  ['id'=>'description', 'class'=>'form-control', 'placeholder'=>'Description']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('author', 'Author name :') !!}
                {!! Form::text('author', null,  ['id'=>'author', 'class'=>'form-control', 'placeholder'=>'Author Name']) !!}
            </div>
            <br>
            <div class="form-group">
                {!! Form::submit( 'Submit', ['id'=>'submit', 'class'=>'btn btn-toolbar']) !!}
                <div class="btn btn-toolbar pull-right"><a href="{{url('/book')}}">Back to Home</a></div>
            </div>
        {!! Form::close() !!}
        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {{--Footer started--}}
    </div>
    <script
			  src="https://code.jquery.com/jquery-2.2.4.min.js"
			  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
			  crossorigin="anonymous"></script>
    <script>
        jQuery(document).ready(function($){
          $('#submit').on('click', function (e) {
              e.preventDefault();
              var title = $('#title').val();
              var desc = $('#description').val();
              var author = $('#author').val();
              $.ajax({
                  type: "POST",
                  url: '{{url('api/v1/book')}}?api_token={{Auth::user()->api_token}}',
                  data: {title: title, description: desc, author: author},
                  success: function( msg ) {
                      location = '{{url('/book')}}';
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown){
                    alert(textStatus);
                  }
              });
          });
        });
    </script>
</body>
</html>
