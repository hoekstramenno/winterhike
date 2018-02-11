<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->

            @if (! Auth::guest())

                @role('Admin')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">Resources
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <router-link :to="{ name: 'users' }">Postbemanning</router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'groups' }">Groups</router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'posts' }">Posts</router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'routes' }">Routes</router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">Settings <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <router-link :to="{ name: 'settings' }">Hike Settings</router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'roles' }">Roles</router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'permissions' }">Permissions</router-link>
                                </li>
                            </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">Results <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <router-link :to="{ name: 'oldresult' }">Result with old calculation</router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'result' }">Result with new calculation</router-link>
                            </li>
                        </ul>
                    </li>

                </ul>
                @endrole


                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">Score Forms
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            @role('Admin')

                                @foreach($posts as $post)
                                    <li>
                                        <router-link :to="{ name: 'forms', params: { id: {{ $post->id }} }}">{{ $post->number . ': ' . $post->name }}</router-link>
                                    </li>
                                @endforeach

                            @endrole

                            @foreach($posts as $post)
                                @role('Postbemanning ' . $post->number)
                                <li>
                                    <router-link :to="{ name: 'forms', params: { id: {{ $post->id }} }}">{{ $post->number . ': ' . $post->name }}</router-link>
                                </li>
                                @endrole
                            @endforeach
                                @role('Admin')
                            <li>
                                <router-link :to="{ name: 'scores' }">Rest of Scores</router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'graphs' }">Graphs</router-link>
                            </li>
                                @endrole
                        </ul>
                    </li>
                </ul>
        @endif
        <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li>
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">Register</a>
                    </li>

                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">

                            <li>
                                <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>