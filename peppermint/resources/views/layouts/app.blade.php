<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- TODO CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    @include('includes.navbar')
    @include('includes.sidebar')
    <div id="content" class="sidebar">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>




</body>
</html>

<!-- Scripts -->
<script src="/js/app.js"></script>

<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('.data-table').DataTable();
        if($("#content").height() > $("html").height())
            $("#sidebar").height( $("#content").height() );
    } );

    function toggleSidebar(el) {
        console.log(el);
        nav = document.getElementById("sidebar");
        cont = document.getElementById("content");

        if( nav.className == "closed" ) {
            nav.className = "";
            cont.className = "sidebar";
            el.className = "open";
        }else {
            nav.className = "closed";
            cont.className = "";
            el.className = "";
        }
    }
</script>
