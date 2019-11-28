@extends('dralf.layouts.base')

@section('title', 'Crear Prueba')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.prueba._form', ['prueba' => $prueba, 'lote' => $lote])
@endsection

@section('javascripts')
    @parent
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src=" {{ asset('vendor/jquery-timepicker/jquery.timepicker.js') }} "></script>
    <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input.timepicker').timepicker({
                timeFormat: 'hh:mm p',
                defaultTime: '11:00',
                minTime: new Date(0,0,0,0,0,0),
                maxTime: new Date(0,0,0,23,55,0),
                interval: 5,
                dynamic: true,
                dropdown: true,
                scrollbar: true
                // timeFormat: 'H:mm',
                // interval: 5,
                // minTime: '0',
                // maxTime: '23:45',
                // defaultTime: '12',
                // startTime: '0',
                // dynamic: false,
                // dropdown: true,
                // scrollbar: true
            });
        });
    </script>
    <script type="text/javascript">
    $( function() {
        $( "#datepicker" ).datepicker({
            minDate: +0,
            maxDate: "+3M +15D",
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ]
         });
    } );
    </script>
    <script type="text/javascript">
    $( function() {
        $( "#datepicker1" ).datepicker({
            minDate: +0,
            maxDate: "+3M +15D",
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ]
         });
    } );
    </script>
@endsection
