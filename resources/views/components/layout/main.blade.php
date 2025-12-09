<!doctype html>
<html lang="en">
<!-- [Head] start -->
<head>
    <x-layout.head-meta />
    <x-layout.head />
</head>
<!-- [Head] end -->
<!-- [Body] Start -->
<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    
    <!-- [ Sidebar Menu ] start -->
    <x-layout.sidebar />
    <!-- [ Sidebar Menu ] end -->
    
    <!-- [ Header Topbar ] start -->
    <x-layout.topbar />
    <!-- [ Header ] end -->
    
    
    
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content" style="padding-bottom: 0.5em">
            <!-- [ Main Content ] start -->
            {{ $slot }}
            {{-- <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat dignissimos qui voluptatum neque earum iusto, fuga omnis recusandae sint natus ratione quas quia illo quod aut, eos dicta. Ex, eligendi?</h1> --}}
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <x-layout.footer />
    <!-- Required Js -->
    <x-layout.scripts />
    <!-- [Page Specific JS] end -->
</body>
<!-- [Body] end -->
</html>
