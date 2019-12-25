@extends('app')
@section('title')

@stop
@section('content')
    <div class="leftpan">

        <div id="printable" style="text-align: center;">
            <img src="{!!url('/')!!}/images/mycash-point-logo.png" alt="mycash point"/>
            <br>
            ---------------------------------------------------------------------------
            <br>
            <h3>Opertor</h3>
            <h3>Top-Up Voucher</h3>
            <h3>* &pound; 63 *</h3>
            ----------------------------------------------------------------------------
            <h3>Pin Number</h3>
            <h3>12355234</h3>
            <h4>Pin Serial Number</h4>
            <h4>12355234</h4>
            ----------------------------------------------------------------------------
            <br>
            12/05/2016
        </div>

        <button id="print"> Print this</button>

    </div>

@stop
@section('footer')

    <script src="{!!url('/')!!}/js/jQuery.print.js"></script>
    <script type="text/javascript">
        $(function () {

            $("#print").on('click', function () {

                $("#printable").print({

                    // Use Global styles
                    globalStyles: false,

                    // Add link with attrbute media=print
                    mediaPrint: false,

                    //Custom stylesheet
                    stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",

                    //Print in a hidden iframe
                    iframe: false,

                    // Don't print this
                    noPrintSelector: ".avoid-this",


                    // Manually add form values
                    manuallyCopyFormValues: true,

                    // resolves after print and restructure the code for better maintainability
                    deferred: $.Deferred(),

                    // timeout
                    timeout: 250,

                    // Custom title
                    title: null,

                    // Custom document type
                    doctype: '<!doctype html>'

                });
            });
        });
    </script>
@stop
