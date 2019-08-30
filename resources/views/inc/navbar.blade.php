<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="row">
          <div class="col-sm-3">
            <img src="{{ asset('images/logo.png') }}" class="navbar-brand img-rounded">
          </div>
          <div class="col-sm-9">
            <b class="navbar-brand text-secondary">Roaming Monitoring System</b>
          </div>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                @if (Auth::guest())
                    header('Location: {{ route('login') }}');
                    die();
                @else
                    <li class="nav-item"><a class="nav-link fa fa-hand-o-right fa-lg" href="#" data-toggle="modal" data-target="#help-modal"> Help</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle fa fa-user-circle-o fa-lg" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a href="{{ route('logout') }}" class="dropdown-item fa fa-sign-out" aria-hidden="true"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg bg-custom-color">
  <div class="container-fluid">
    <ul class="navbar-nav navbar-fixed-top">
        <li class="nav-item">
            <a class="nav-link text-custom-color {{ Request::segment(1) === 'dashboard' ? 'text-custom-active' : null }}"
            href="{{ url('dashboard' )}}" >Dashboard</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link text-custom-color {{ Request::segment(1) === 'real-time-monitor' ? 'text-custom-active' : null }}"
            href="{{url('real-time-monitor')}}"> Real Time Monitor</a>
        </li>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-custom-color"
           href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Subscriber analysis
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('all-sub')}}">ALL subscriber</a>
            <a class="dropdown-item" href="{{ url('vip-sub')}}">VIP subscriber</a>
          </div>
        </li> -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-custom-color "
               href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Traffic & Quality
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{url('daily_report')}}">Daily - Report</a>
                <a class="dropdown-item" href="{{url('report/traffic_report')}}">Traffic - Report</a>
                <a class="dropdown-item" href="{{url('report/quality_report')}}">Quality - Report</a>
            </div>
        </li>
        <li class="nav-item ">
            <a class="nav-link text-custom-color {{ Request::segment(1) === 'report'}}"
            href="{{url('report')}}">Business report</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-custom-color "
            href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reference
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <h5 class="dropdown-header">Reference</h5>
            <a class="dropdown-item" href="{{ url('reference-rp')}}">Reference_RP</a>
            <a class="dropdown-item" href="{{ url('threshold')}}">Threshold</a>
            <a class="dropdown-item" href="{{ url('vip-subscriber')}}">VIP Sub list</a>
            <h5 class="dropdown-header">Subscriber analysis</h5>
            <a class="dropdown-item" href="{{ url('call-center')}}">CALL CENTER</a>
            <a class="dropdown-item" href="{{ url('hotline')}}">HOTLINE</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-custom-color" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            DB Query
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <h5 class="dropdown-header">CDR record</h5>
            <a class="dropdown-item" href="{{ url('outbound-nrt')}}">outbound-nrt</a>
            <a class="dropdown-item" href="{{ url('outbound-tap')}}">outbound-tap</a>
            <a class="dropdown-item" href="{{ url('inbound-nrt')}}">inbound-nrt</a>
            <a class="dropdown-item" href="{{ url('inbound-tap')}}">inbound-tap</a>
            <h5 class="dropdown-header">Other</h5>
            <a class="dropdown-item" href="{{ url('stp-transaction')}}">stp-transaction</a>
            <a class="dropdown-item" href="{{ url('reference-rp-history')}}">reference_rp_history</a>
          </div>
        </li>
   </ul>
  </div>
</nav>
