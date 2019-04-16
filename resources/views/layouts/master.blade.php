<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <title>Laravel練習 @yield('title')</title>
    
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <link rel="stylesheet" href="{{ URL::asset('css/standard.css')}}">

    <!--PWA-->
    <link rel="manifest" href="/manifest.json">
    <script type="text/javascript" src="{{ URL::asset('js/pwa.js') }}"></script>
</head>
<body>
    <div id="id_wrapper">
        <div id="id_header">
            @include('../menu/header')
        </div> 
        <div id="id_content">
            @yield('content')
        </div> 
        <footer id="id_footer">
            @include('../menu/footer')
        </footer> 
    </div> 
    <script>
        $(document).ready(function(e){
            $('#user_select').change(function(){
                var user_id = $('#user_select').val();
                var url="{{ url('/search_user') }}";
                if(user_id != "")
                {
                    $.ajax({
                        type: "POST",
                        url: url,
                        dataType: "html",
                        data: { "_token": "{{ csrf_token() }}"
                                , user_id: user_id }
                    }).fail(function(e){
                        console.log(e);
                    });
                }
            });
        });
    </script>  
</body>
</html>