@if ($paginator->lastPage() > 1)
<ul class="uk-pagination uk-flex-center uk-margin-medium-top" uk-margin>
    <li class="{{ !($paginator->currentPage() == 1) ?: 'uk-disabled' }}">
        <a href="{{ $paginator->url(1) }}">
            <span uk-pagination-previous></span>
        </a>
    </li>
    <li class="uk-disabled {{ !($paginator->currentPage() - 5 <= 1 ) ?: 'uk-hidden' }}"><span>...</span></li>
    @php
        $minPag = ($paginator->currentPage() - 5 <= 1 ) ? 1 : $paginator->currentPage() - 5;
        $maxPag = ($paginator->currentPage() + 5 >= $paginator->lastPage()) ? $paginator->lastPage() : $paginator->currentPage() + 5;
    @endphp
    @for ($i = $minPag; $i <= $maxPag; $i++)
        <li class="{{ !($paginator->currentPage() == $i) ?: 'uk-active' }}">
            <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="uk-disabled {{ !($paginator->currentPage() + 5 >= $paginator->lastPage()) ?: 'uk-hidden' }}"><span>...</span></li>
    <li class="{{ !($paginator->currentPage() == $paginator->lastPage()) ?: 'uk-disabled' }}">
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}"><span uk-pagination-next></span></a>
    </li>
</ul>
@endif
