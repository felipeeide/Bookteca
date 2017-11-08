<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
    <body>
    <div class="container">
        {{--Header finished--}}
        <div class="row col-xs-8 col-xs-offset-2 img-rounded text-center" style="background-color: #eee;">
            <div ><h2>{{ $book->title }}</h2></div>
            <div >{{ $book->description }}</div>
            <div class="blockquote-reverse">Published by -{{ $book->author }}</div>
            <div class="btn btn-toolbar"><a href="{{url('/book')}}">Back to Home</a></div>
        </div>
        {{--Footer Started--}}
    </div>
    </body>
</html>
