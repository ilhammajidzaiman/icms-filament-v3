<div>
    <h1>
        {{ $article->title }}
    </h1>
    <img src="{{ $article->file }}" alt="{{ $article->file }}">
    <div>
        {{ $article->content }}
    </div>
</div>
