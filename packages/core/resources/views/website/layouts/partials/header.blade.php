<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white rounded-0 border-bottom">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="assets/images/brand-logo-2.png" width="140" alt="" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{__('core::website.home')}}</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0"></ul>
                <div class="d-flex ms-3 gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm px-4 radius-30">{{__('core::website.login_here')}}</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
</header>
