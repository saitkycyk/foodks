
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col--md-4 col-sm-4 col-xs-4">
                <a href="index.html" id="logo">
                    <img src="/img/logo.png" width="190" height="23" alt="" data-retina="true" class="hidden-xs">
                    <img src="/img/logo_mobile.png" width="59" height="23" alt="" data-retina="true" class="hidden-lg hidden-md hidden-sm">
                </a>
            </div>
            <nav class="col--md-8 col-sm-8 col-xs-8">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="/img/logo.png" width="190" height="23" alt="" data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                    <ul>
                        <li><a href="/">Kryefaqja</a></li>
                        <li><a href="/restaurants">Restorantët</a></li>
                        <li><a href="/about">Rreth nesh</a></li>
                        @guest
                        <li><a href="#" data-toggle="modal" data-target="#login_2" id="login">Kyqu</a></li>
                        @endguest
                        @auth
                        @if(auth()->user()->restaurant)
                        <li><a href="/admin">Menaxhimi</a></li>
                        @endif
                        @if(!auth()->user()->restaurant)
                        <li><a href="/profile">Profili</a></li>
                        @elseif(auth()->user()->restaurant)
                        <li><a href="{{'/restaurant/'.auth()->user()->id.'/profile'}}">Profili</a></li>
                        @endif
                        <form hidden id="form1" action="/logout" method="post">
                            @csrf
                        </form>
                        <li><a href="javascript:;" onclick="document.getElementById('form1').submit();">Shkyqu</a></li>
                        @endauth
                    </ul>
                </div><!-- End main-menu -->
            </nav>
        </div><!-- End row -->
    </div><!-- End container -->
</header>