<ol class="dd-list">
    @foreach ($items as $item)
        <li class="dd-item" data-id="{{ $item->id }}">
            <div class="dd-handle">
                <span class="drag-indicator"></span>
                <div>{{ $item->title }} <span class="url text-secondary">{{ $item->link() }}</span></div>
                <div class="dd-nodrag btn-group ml-auto item_actions">
                    <button class="btn btn-sm btn-outline-light edit"
                        data-id="{{ $item->id }}"
                        data-title="{{ $item->title }}"
                        data-url="{{ $item->url }}"
                        data-target="{{ $item->target }}"
                        data-icon_class="{{ $item->icon_class }}"
                        data-route="{{ $item->route }}">
                        Editar
                    </button>
                    <button class="btn btn-sm btn-outline-light delete"
                        data-id="{{ $item->id }}">
                    <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            @if(!$item->children->isEmpty())
                @include('menu.items', ['items' => $item->children])
            @endif
        </li>
    @endforeach
</ol>
