<div>
    <div class="text-3xl text-emerald-300 font-black">{{ $fact->title }}</div>

    <div class="text-2xl">{!! $fact->text !!}</div>

    @foreach($fact->images as $image)
        <img src="{{ asset('media/images/' . $image->name) }}">
    @endforeach

    @if($fact->category)
        {{ $fact->category->name }}
    @endif

    @foreach($fact->tags as $tag)
        {{ $tag->name }}
    @endforeach
</div>