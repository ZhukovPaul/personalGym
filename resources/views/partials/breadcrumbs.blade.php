@unless ($breadcrumbs->isEmpty())
    <ul class="list-unstyled list-inline au-breadcrumb__list">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="list-inline-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                <li class="list-inline-item seprate"><span>/</span></li>
            @else
                <li class="list-inline-item">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ol>
@endunless