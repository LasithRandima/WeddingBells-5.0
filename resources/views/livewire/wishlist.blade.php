{{-- <style>
    .heart-position {
        position: relative;
        background-color: #333;
        z-index: 100;
    }

    .heartIcon {
        position: absolute;
        top: 10px; /* Adjust the top position as needed */
        right: 10px; /* Adjust the right position as needed */
        z-index: 100;
        cursor: pointer;
    }
</style>

<div class="heart-position">
    <button type="button" class="heartIcon" wire:click="toggleWishlist">
        <i class="fas fa-heart {{ $wishlist ? 'text-danger' : 'text-secondary' }}" style="font-size: 1.1em; font-weight: 200;"></i>
    </button>
</div> --}}

        <i class="bi bi-suit-heart-fill  {{ $wishlist ? 'text-danger' : 'text-secondary' }}" style="font-size: 1.1em; font-weight: 200;" wire:click="toggleWishlist"></i>


