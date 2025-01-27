@extends('layouts.admin.master')

@section('admin')
    <style>
        p img {
            width: 80%;
            margin-inline: 10%;
        }
    </style>
    <main>
        <!-- Blog Content Section -->
        <div class="blog-content py-5">
            <div class="container">
                <div class="row ">
                    <div class="col-md-12  mb-4 card">
                        <div class=" card-body">
                          
                            <h1 class="fw-bold text-center text-dark">  <i class="fa fa-bell fa-2x text-dark" style="font-size:23px"></i>
                                Notifications</h1>
                        </div>
                    </div>
                </div>
                    @forelse($notifications as $notification)
                    @foreach ($notification->notificationUsers as $notificationUser)
                    @endforeach
                    @if ($notificationUser->user_id == Auth::id())
                    <div class="row ">
                        <div class="col-md-12  mb-4 card">
                            <div class="row card-body">
                                {{-- <div class="col-md-1">
                                    <i class="fa fa-bell fa-2x" style="color: white;background-color: #0eb98d;padding: 10px;border-radius: 50%;font-size:30px"></i>

                                </div> --}}
                                <div class="col-md-12">
                                    <strong>{{ $notification->title }}</strong>
                                    <span class="text-muted d-block">
                                        {{ $notification->message }}
                                    </span>
                                    <p class="m-0">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                </div>
                @endif
                {{-- <div class="">
                        <a href="{{ route('notification.show', $notification->id) }}"
                            class="text-decoration-none" style="font-size:20px">
                            <strong>{{ $notification->title }}</strong>

                            <span class="text-muted d-block">
                                {{ \Illuminate\Support\Str::limit($notification->message, 50, '...') }}
                            </span>
                            <p class="m-0">{{ $notification->created_at->diffForHumans() }}</p>
                        </a>
                        <hr style="margin-bottom: 30px">
                    </div> --}}
            @empty
                @endforelse


            </div>
        </div>
        </div>
    </main>
@endsection
