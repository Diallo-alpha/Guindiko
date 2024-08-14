<!-- resources/views/notifications/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Vos Notifications</h1>

        @if ($unreadNotifications->isEmpty())
            <p>Aucune nouvelle notification.</p>
        @else
            <ul>
                @foreach ($unreadNotifications as $notification)
                    <li>
                        {{ $notification->data['message'] }} <br>
                        <small>Reçue le : {{ $notification->created_at->format('d/m/Y H:i:s') }}</small>
                    </li>
                @endforeach
            </ul>

            <form action="{{ route('notifications.markAsRead') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Marquer tout comme lu</button>
            </form>
        @endif
    </div>
@endsection
