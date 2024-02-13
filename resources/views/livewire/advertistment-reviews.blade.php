<?php

$initials ='';

if (Auth::user()) {
    $name = Auth::user()->name; // replace this with the actual name from the database
    $parts = explode(' ', $name); // split the name into parts using the space character as the separator
    $first_letter = strtoupper(substr($parts[0], 0, 1)); // get the first letter of the first name and convert it to uppercase
    $second_letter = isset($parts[1]) ? strtoupper(substr($parts[1], 0, 1)) : ''; // get the first letter of the second name and convert it to uppercase if it exists
    $initials = $first_letter . $second_letter; // concatenate the two initials
}


?>
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Reviews ({{ $totalReviews }})</h5>
            <hr>

            @forelse ($reviews as $item)
            @php
                $initials ='';

                $name = $item->name; // replace this with the actual name from the database
                $parts = explode(' ', $name); // split the name into parts using the space character as the separator
                $first_letter = strtoupper(substr($parts[0], 0, 1)); // get the first letter of the first name and convert it to uppercase
                $second_letter = isset($parts[1]) ? strtoupper(substr($parts[1], 0, 1)) : ''; // get the first letter of the second name and convert it to uppercase if it exists
                $initials = $first_letter . $second_letter; // concatenate the two initials
            @endphp
                <blockquote class="{{ !$loop->last ? 'border-bottom' : '' }}">
                    <div class="float-lg-end d-flex mb-3">
                        <div class="btn-group d-inline-flex me-2">
                            <button class="btn btn-light btn-sm float-end" data-bs-toggle="tooltip" data-bs-title="Like">
                                <i class="fa fa-thumbs-up"></i>
                            </button>
                            <button class="btn btn-light btn-sm float-end" data-bs-toggle="tooltip" data-bs-title="Dislike">
                                <i class="fa fa-thumbs-down"></i>
                            </button>
                        </div>
                        @auth
                        <button type="button" wire:click="deleteReview({{ $item->review_id}})" class="btn btn-light btn-sm float-end">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endauth

                    </div>
                    <div class="icontext">
                        {{-- <img src="{{ url('images/avatars/avatar.webp') }}" class="img-xs icon rounded-circle"> --}}
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                        <img class="rounded-circle"
                        height="50" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" loading="lazy" />

                        @else
                        <div class="bg-light text-secondary border border-danger rounded-circle" style="width: 50px; height:50px; display:flex; justify-content:center; align-items:center;"><b>{{ $initials }}</b></div>

                        {{-- <div class="profile_avatar">{{ $initials }}</div> --}}
                        @endif
                        <div class="text ms-2">
                            <h6 class="mb-0"> {{ $item->name }} </h6>
                            <div class="rating-wrap">
                                <ul class="rating-stars">
                                    <li style="width:{{ $item->review->percent }}%" class="stars-active">
                                        <img src="{{ url('images/misc/stars-active.svg') }}" alt="">
                                    </li>
                                    <li>
                                        <img src="{{ url('images/misc/starts-disable.svg') }}" alt="">
                                    </li>
                                </ul>
                                <b class="dot"></b>
                                <small class="label-rating text-muted"> Reviewed On {{ $item->review->created_at->format('Y-m-d') }} </small>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p> {{$item->review->review}} </p>
                    </div>
                </blockquote>
            @empty
                @auth
                    <div>Be the first to review this Advertisement.</div>
                @endauth
                @guest
                    <div>Login and be the first to review this Advertisement.</div>
                @endguest
            @endforelse
            @if ($reviews->count() < $totalReviews)
                <button wire:click.prevent="load" type="button" class="btn btn-primary" wire:loading.attr="disabled">Load more</button>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Review and Rating </h5>
            @auth

                <form wire:submit="addReview">
                    <input type="hidden"  wire:model.live="ad_id" value="{{ $topAd->id }}">
                    <input type="hidden"  wire:model.live="v_id" value="{{ $topAd->v_id }}">
                    <input type="hidden"  wire:model.live="actaul_v_id" value="{{ $topAd->actual_v_id }}">
                    <input type="hidden"  wire:model.live="c_id" value="{{ Auth::id() }}">
                    <input type="hidden"  wire:model.live="advertisement" value="{{ $topAd }}">
                    @php
                    $client_actual = DB::table('clients')
                            ->select('id')
                            ->where('user_id', '=', Auth::id())
                            ->value('id');
                    @endphp
                    <input type="hidden"  wire:model.live="actual_c_id" value="{{ $client_actual }}">


                    <div class="stars @error('rating') is-invalid @enderror">
                        <input wire:model.live="rating" class="star star-5" id="star-5" type="radio" value="5" name="rating"/>
                        <label class="star star-5" for="star-5"></label>
                        <input wire:model.live="rating" class="star star-4" id="star-4" type="radio" value="4" name="rating"/>
                        <label class="star star-4" for="star-4"></label>
                        <input wire:model.live="rating" class="star star-3" id="star-3" type="radio" value="3" name="rating"/>
                        <label class="star star-3" for="star-3"></label>
                        <input wire:model.live="rating" class="star star-2" id="star-2" type="radio" value="2" name="rating"/>
                        <label class="star star-2" for="star-2"></label>
                        <input wire:model.live="rating" class="star star-1" id="star-1" type="radio" value="1" name="rating"/>
                        <label class="star star-1" for="star-1"></label>
                    </div>
                    @error('rating')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                    <div class="mb-3">
                       
                        <textarea wire:model.live="review" class="form-control @error('review') is-invalid @enderror" placeholder="Type here"></textarea>
                        @error('review')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Submit</button>
                </form>
            @endauth
            @guest
                <div>Please login to review</div>
            @endguest
        </div>
    </div>
</div>
