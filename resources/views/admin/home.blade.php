@extends('layouts.admin')

@section('content')
    <div class="container" v-cloak>
        <transition name="fade">
            <router-view></router-view>
        </transition>
    </div>
@endsection
