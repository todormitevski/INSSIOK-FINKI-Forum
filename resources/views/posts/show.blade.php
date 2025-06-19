@extends('layouts.root-layout')

@section('content')
    <div class="container my-5">
        <div class="mb-4">
            <h5 class="text-muted">{{ $subject->name }}</h5>
            <div class="bg-white rounded shadow-sm p-4">

                <div class="d-flex align-items-center mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=random"
                         alt="{{ $post->user->name }}" class="rounded-circle me-3" width="50" height="50">
                    <div>
                        <div class="fw-semibold text-dark">Posted by {{ $post->user->name }}</div>
                        <small class="text-muted">{{ $post->created_at->format('F j, Y \a\t H:i') }}</small>
                    </div>
                </div>

                <h2 class="fw-bold">{{ $post->title }}</h2>
                <p class="lead mb-3">{{ $post->content }}</p>

                @if ($post->attachments && $post->attachments->count())
                    <div class="mt-3">
                        <p class="mb-1 text-muted fw-semibold">📎 Attachments:</p>
                        <ul class="list-unstyled">
                            @foreach ($post->attachments as $attachment)
                                <li>
                                    <a href="{{ route('attachments.download', $attachment->id) }}">{{ $attachment->file_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-5">
            <h3 class="mb-4">💬 Comments</h3>

            @foreach ($comments as $comment)
                <x-comment :comment="$comment" />
            @endforeach

            @if($comments->whereNull('parent_id')->isEmpty())
                <p class="text-muted">No comments yet for this post.</p>
            @endif
        </div>

        @auth
            <div class="card shadow-sm mb-5">
                <div class="card-header bg-primary text-white fw-semibold">
                    Add a Comment
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('posts.comments.store', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="parent_id" id="parent_id" value="">

                        <div id="cancel-reply-container" class="mb-2" style="display: none;">
                            <span class="text-muted">Replying to: <span id="replying-to-name"></span></span>
                            <button type="button" id="cancel-reply" class="btn btn-sm btn-outline-danger ms-2">
                                <i class="fas fa-times"></i> Cancel Reply
                            </button>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Your Comment</label>
                            <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="attachments" class="form-label">Attachments</label>
                            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const parentIdInput = document.getElementById('parent_id');
            const contentTextarea = document.getElementById('content');
            const cancelReplyContainer = document.getElementById('cancel-reply-container');
            const replyingToName = document.getElementById('replying-to-name');
            const cancelReplyBtn = document.getElementById('cancel-reply');

            function resetReplyState() {
                parentIdInput.value = '';
                contentTextarea.placeholder = '';
                cancelReplyContainer.style.display = 'none';

                document.querySelectorAll('.bg-light').forEach(el => {
                    el.style.backgroundColor = '';
                });
            }

            document.querySelectorAll('.reply-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id');
                    const commentAuthor = this.closest('.bg-light').querySelector('.fw-semibold').textContent;

                    parentIdInput.value = commentId;
                    contentTextarea.focus();
                    contentTextarea.placeholder = `Replying to ${commentAuthor}...`;

                    replyingToName.textContent = commentAuthor;
                    cancelReplyContainer.style.display = 'block';

                    contentTextarea.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });

                    document.querySelectorAll('.bg-light').forEach(el => {
                        el.style.backgroundColor = '';
                    });
                    this.closest('.bg-light').style.backgroundColor = '#f0f8ff';
                });
            });

            cancelReplyBtn.addEventListener('click', function() {
                resetReplyState();
            });

        });
    </script>
@endsection
