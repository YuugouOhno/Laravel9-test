<x-app-layout>
    <x-slot name="header">
        Index
    </x-slot>
    <div class='posts'>
        @foreach ($posts as $post)
            <div class='post'>
                <h2 class='title font-bold'>
                    <a href='/posts/{{ $post->id }}'>{{ $post->title }}</a>
                </h2>
                <p class='body'>{{ $post->body }}</p>
                <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                <button onclick="like({{$post->id}})">いいね</button>
                <button onclick="unlike({{$post->id}})">いいね解除</button>
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                </form>
            </div>
        @endforeach
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        function deletePost(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
        function like(postId) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: `/like/${postId}`,
                type: "POST",
            })
            .done(function (data, status, xhr) {
                console.log(data);
            })
            .fail(function (xhr, status, error) {
                console.log();
            });
        }
        function unlike(postId) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: `/unlike/${postId}`,
                type: "POST",
            })
            .done(function (data, status, xhr) {
                console.log(data);
            })
            .fail(function (xhr, status, error) {
                console.log();
            });
        }

    </script>
</x-app-layout>

