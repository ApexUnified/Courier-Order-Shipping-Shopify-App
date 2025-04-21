<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="shopify-api-key"
        content="{{ \Osiset\ShopifyApp\Util::getShopifyConfig('api_key', $shopDomain ?? Auth::user()->name) }}" />
    <script src="https://cdn.shopify.com/shopifycloud/app-bridge.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
        integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/static/js/DataTable-Button-Assets/css/DataTablesButton.css') }}">

    <title>{{ config('shopify-app.app_name') }}</title>
    @yield('styles')
</head>

<body>
    <div class="app-wrapper">
        <div class="app-content">
            <main role="main">
                @yield('content')
            </main>
        </div>
    </div>
    @if (\Osiset\ShopifyApp\Util::useNativeAppBridge())
        @include('shopify-app::partials.token_handler')
    @endif

    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/DataTable-Button-Assets/js/DataTablesButtons.js') }}"></script>
    <script src="{{ asset('assets/static/js/DataTable-Button-Assets/js/DataTablesExcelButton.js') }}"></script>
    <script src="{{ asset('assets/static/js/DataTable-Button-Assets/js/DataTableshtml5.js') }}"></script>
    <script src="{{ asset('assets/static/js/DataTable-Button-Assets/js/DataTablesPdf.js') }}"></script>
    <script src="{{ asset('assets/static/js/DataTable-Button-Assets/js/DataTablesPdfFont.js') }}"></script>
    <script src="{{ asset('assets/static/js/DataTable-Button-Assets/js/DataTablesPrint.js') }}"></script>

    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>


    @yield('scripts')
</body>

</html>
