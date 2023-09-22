
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title> {{ __('Store App') }} </title>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-M8S4MT3EYG');
</script>


<!-- Libs CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<link href="{{asset('assets/css/bootstrap-icons.css')}}"rel="stylesheet">
{{-- <link href="{{asset('assets/css/materialdesignicons.min.css')}}"rel="stylesheet"> --}}
{{-- <link href="{{asset('assets/css/dropzone.css')}}"rel="stylesheet"> --}}
<link href="https://dashui.codescandy.com/dashuipro/assets/libs/@mdi/font/css/materialdesignicons.min.css"rel="stylesheet">
    
    <!-- Theme CSS -->
    <link rel="stylesheet" href="https://dashui.codescandy.com/dashuipro/assets/css/theme.min.css">
    <link href="https://dashui.codescandy.com/dashuipro/assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">
<link href="https://dashui.codescandy.com/dashuipro/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@stack('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function updateTextarea(element)
    {
        document.getElementById(element).innerText = document.getElementById("ment").value;
    }
</script>