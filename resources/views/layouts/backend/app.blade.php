<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>
	@include('layouts.backend.style')	

	<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    @include('layouts.backend.js')

    <script type="text/javascript">
        $(document).ready(function() {

        /*$('#show').load('{{ url('pemesanan/notifPemesanan') }}');
        $('#show1').load('{{ url('pemesanan/notifPemesanan') }}');*/
        $('#show2').load("{{ url('pemesanan/dataPemesanan') }}");

        /*setInterval(function()
        {
            $('#show').load('{{ url('pemesanan/notifPemesanan') }}');
            $('#show1').load('{{ url('pemesanan/notifPemesanan') }}');
            $('#show2').load('{{ url('pemesanan/dataPemesanan') }}');

        }, 10000);*/
    });
    </script>
    
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('layouts.backend.top')
    @include('layouts.backend.side')
    @yield('content')
    @include('layouts.backend.footer')
</div>
</body>
</html>
@yield('js')