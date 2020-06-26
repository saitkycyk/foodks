<title>Haja Te Dera - Shpejt & Shijshëm</title>
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col--md-4 col-sm-4 col-xs-4">
                <a href="/" id="logo">
                    <img src="/img/logo.png" width="200" height="40" alt="" style="margin-bottom: 10px" data-retina="true" class="hidden-xs">
                    <img src="/img/logo_mobile.png" width="55" height="30" alt="" data-retina="true" class="hidden-lg hidden-md hidden-sm">
                </a>
            </div>
            <nav class="col--md-8 col-sm-8 col-xs-8">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu" style="margin-top: 5px">
                    <div id="header_menu">
                        <img src="/img/logo.png" width="200" height="40" alt="" data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                    <ul>
                        <li><a href="/">Kryefaqja</a></li>
                        <li><a href="/restaurants">Restorantët</a></li>
                        <li><a href="/about">Rreth nesh</a></li>
                        <li id="app"><a href="/contacts">Kontakti</a></li>
                        @guest
                        <li><a href="#" data-toggle="modal" data-target="#login_2" id="login">Kyqu</a></li>
                        @endguest
                        @auth
                        <li class="submenu">
                            <a href="javascript:void(0);" class="show-submenu">Llogaria<i class="icon-down-open-mini"></i></a>
                            <ul>
                                @if(!auth()->user()->restaurant)
                                <li><a href="/orders">Porositë</a></li>
                                <li><a href="/profile">Profili</a></li>
                                @elseif(auth()->user()->restaurant)
                                <li><a href="/orders/restaurant">Porositë</a></li>
                                <li><a href="{{'/restaurant/'.auth()->user()->id.'/profile'}}">Profili</a></li>
                                <li><a href="/admin">Menaxhimi</a></li>
                                @endif
                                <form hidden id="logoutForm" action="/logout" method="post">
                                    @csrf
                                </form>
                                <li><a href="javascript:;" onclick="document.getElementById('logoutForm').submit();">Shkyqu</a></li>
                            </ul>
                        </li>
                        @endauth
                    </ul>
                </div><!-- End main-menu -->
            </nav>
        </div><!-- End row -->
    </div><!-- End container -->

    @auth
    <script src="/js/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/styles/toastr.css')}}">
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <script src="/js/app.js"></script>
    <script type="text/javascript">

        var auth = {!! auth()->user()->id !!};
        Echo.channel('orders' + auth)
        .listen('OrdersUpdated', (e) => {
            toastr.info("Keni ndryshime të reja në porosi, ju lutem freskoni faqën!", "Njoftim!", {
                timeOut: 0
            });
        });

        $.noConflict();
    </script>
    @endauth
</header>