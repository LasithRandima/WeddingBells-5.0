<div class="img_container">
    @forelse ($gallery as $gimage)
        <a href="{{ $gimage->image_path ? asset('/storage/'.$gimage->image_path) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="{{ $gimage->image_path }}" class="fancybox greyscale" data-fancybox="gallery1">
            <div class="img_box">
            <img src="{{ $gimage->image_path ? asset('/storage/'.$gimage->image_path) : asset('/storage/default_images/default_category_thumb.jpg')  }}" alt="{{ $gimage->image_path }}" width="100%" height="100%">
            </div>
        </a>
    @empty
    <div class="alert alert-danger">
        Gallery is empty.
      </div>
    @endforelse
</div>

