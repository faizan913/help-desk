<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    {{-- Code Mirror --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/codemirror/theme/monokai.css') }}">

    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        {{-- @include('include.navbar') --}}
        @include('include.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('include.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script type="text/javascript" src='{{ asset('plugins/jquery/jquery.min.js') }}'></script>
    <!-- jQuery UI 1.11.4 -->
    <script type="text/javascript" src='{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}'></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script type="text/javascript" src='{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}'></script>
    <!-- ChartJS -->
    <script type="text/javascript" src='{{ asset('plugins/chart.js/Chart.min.js') }}'></script>
    <!-- Sparkline -->
    <script type="text/javascript" src='{{ asset('plugins/sparklines/sparkline.js') }}'></script>
    <!-- JQVMap -->
    <script type="text/javascript" src='{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}'></script>
    <!-- jQuery Knob Chart -->
    <script type="text/javascript" src='{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}'></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src='{{ asset('plugins/moment/moment.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/daterangepicker/daterangepicker.js') }}'></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script type="text/javascript"
        src='{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}'></script>
    <!-- Summernote -->
    <script type="text/javascript" src='{{ asset('plugins/summernote/summernote-bs4.min.js') }}'></script>
    <!-- overlayScrollbars -->
    <script type="text/javascript" src='{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}'>
    </script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src='{{ asset('dist/js/adminlte.js') }}'></script>
    <!-- AdminLTE for demo purposes -->
    <script type="text/javascript" src='{{ asset('dist/js/demo.js') }}'></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script type="text/javascript" src='{{ asset('dist/js/pages/dashboard.js') }}'></script>

    <!-- DataTables  & Plugins need to put in seprate file -->
    <script type="text/javascript" src='{{ asset('plugins/datatables/jquery.dataTables.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}'>
    </script>
    <script type="text/javascript" src='{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}'>
    </script>
    <script type="text/javascript" src='{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/jszip/jszip.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/pdfmake/pdfmake.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/pdfmake/vfs_fonts.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}'></script>

    {{-- Code mirror --}}

    <script type="text/javascript" src='{{ asset('plugins/codemirror/codemirror.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/codemirror/mode/css/css.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/codemirror/mode/xml/xml.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}'></script>
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
    <!-- jquery-validation -->
    <script type="text/javascript" src='{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('plugins/jquery-validation/additional-methods.min.js') }}'></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
</body>

</html>
