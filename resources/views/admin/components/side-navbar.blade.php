@section('side-navbar')
    <div class="sidebar" data-background-color="white" data-active-color="warning">
        <!--
            Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
            Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
        -->
        <div class="logo">
            <a href="{{URL::to('/admin')}}" class="simple-text">
                ADMIN DASHBOARD
            </a>
        </div>
        <div class="logo logo-mini">
            <a href="{{URL::to('/home')}}" class="simple-text">
                JP
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="{{ session('avatar') }}"/>
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                        {{ Auth::user()->name }}
                    </a>
                </div>
            </div>
            <ul class="nav">
                @if(session('admin_nav'))
                    @foreach(session('admin_nav') as $item)
                        @if(array_key_exists('add', $item['actions']))
                            <li @if (Request::is('admin/'.strtolower($item['name']).'/create*') || Request::is('admin/'.strtolower($item['name']))) class="active" @endif>
                                <a data-toggle="collapse" href="#componentsExamples">
                                    <i class="{{$item['icon']}}"></i>
                                    <p>{{$item['name']}}
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <div @if (Request::is('admin/'.strtolower($item['name']).'/create*') || Request::is('admin/'.strtolower($item['name']))) class="collapse in" @else class="collapse" @endif id="componentsExamples">
                                    <ul class="nav">
                                        <li @if (Request::is('admin/'.strtolower($item['name']).'/create*')) class="active" @endif><a href="{{ url($item['actions']['add'])}}">Add</a></li>
                                        <li @if (Request::is('admin/'.strtolower($item['name']))) class="active" @endif><a href="{{ url($item['actions']['view'])}}">View</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @elseif(array_key_exists('room_booking', $item['actions']) || array_key_exists('event_booking', $item['actions']))
                            <li @if (Request::is('admin/'.strtolower($item['name']).'/*')) class="active" @endif>
                                <a data-toggle="collapse" href="#componentsExamples">
                                    <i class="{{$item['icon']}}"></i>
                                    <p>{{$item['name']}}
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <div @if (Request::is('admin/'.strtolower($item['name']).'/*')) class="collapse in" @else class="collapse" @endif id="componentsExamples">
                                    <ul class="nav">
                                        <li @if (Request::is('admin/'.strtolower($item['name']).'/room_booking')) class="active" @endif><a href="{{ url($item['actions']['room_booking'])}}">Room Bookings</a></li>
                                        <li @if (Request::is('admin/'.strtolower($item['name']).'/event_booking')) class="active" @endif><a href="{{ url($item['actions']['event_booking'])}}">Event Bookings</a></li>
                                    </ul>
                                </div>
                            </li>
                        @else
                            <li @if (Request::is('admin/'.strtolower($item['name']).'/*')) class="active" @endif>
                                <a href="{{ url($item['actions']['view'])}}">
                                    <i class="{{$item['icon']}}"></i>
                                    <p>{{$item['name']}}</p>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
@show
