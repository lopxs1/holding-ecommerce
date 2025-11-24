@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navegação de paginação">
        {{-- Mobile --}}
        <div class="d-flex justify-content-between d-sm-none">
            @if ($paginator->onFirstPage())
                <span class="btn btn-outline-secondary disabled">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-outline-primary">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-outline-primary">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="btn btn-outline-secondary disabled">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        {{-- Desktop --}}
        <div class="d-none d-sm-flex flex-1 gap-2 align-items-center justify-content-between mt-2">
            <div>
                <p class="mb-0 text-muted">
                    Mostrando
                    @if ($paginator->firstItem())
                        <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                        a
                        <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    de
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    resultados
                </p>
            </div>

            <div>
                <span class="btn-group">
                    {{-- Previous --}}
                    @if ($paginator->onFirstPage())
                        <span class="btn btn-outline-secondary disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            &laquo;
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-outline-primary" aria-label="@lang('pagination.previous')">
                            &laquo;
                        </a>
                    @endif

                    {{-- Pages --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span class="btn btn-outline-secondary disabled">{{ $element }}</span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="btn btn-primary active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="btn btn-outline-primary" aria-label="{{ __('Ir para a página :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-outline-primary" aria-label="@lang('pagination.next')">
                            &raquo;
                        </a>
                    @else
                        <span class="btn btn-outline-secondary disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            &raquo;
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
