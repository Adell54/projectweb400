<style>
    .custom-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.custom-pagination a {
    margin: 0 5px;
    padding: 10px;
    border: 1px solid #F28123;
    border-radius: 5px;
    text-decoration: none;
    color: black;
    transition: background-color 0.3s;
}

.custom-pagination a:hover {
    background-color: #F28123;
    color: white;
}

.custom-pagination .active {
    background-color: #F28123;
    color: white;
    padding: 10px;
    border-radius: 5px;
}

.custom-pagination .disabled {
    margin: 0 5px;
    padding: 10px;
    color: gray;
}

</style>
<div class="custom-pagination">
    @if ($paginator->onFirstPage())
        <span class="disabled">« Previous</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}">« Previous</a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="disabled">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}">Next »</a>
    @else
        <span class="disabled">Next »</span>
    @endif
</div>
