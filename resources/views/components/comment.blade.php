@props(['comment', 'level' => 0])

<div class="bg-light rounded p-3 mt-3 {{ $level > 0 ? 'ms-' . min($level * 4, 48) : '' }}" style="border-left: 3px solid #dee2e6;">
    <div class="d-flex align-items-center mb-2">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random"
             alt="{{ $comment->user->name }}" class="rounded-circle me-2" width="30">
        <span class="fw-semibold">{{ $comment->user->name }}</span>
    </div>
    <p>{{ $comment->content }}</p>

    @if ($comment->attachments->count())
        <div class="mt-2">
            <p class="mb-1 text-muted">📎 Attachments:</p>
            <ul class="list-unstyled">
                @foreach ($comment->attachments as $attachment)
                    <li>
                        <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">
                            {{ $attachment->file_name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <button class="btn btn-sm btn-outline-primary reply-btn mt-2"
            data-comment-id="{{ $comment->id }}">
        <i class="fas fa-reply"></i> Reply
    </button>

    {{-- for displaying nested replies --}}
    @if ($comment->replies->count())
        @if ($level < 4)
            @foreach ($comment->replies as $reply)
                <x-comment :comment="$reply" :level="$level + 1" />
            @endforeach
        @else
            <div class="mt-2 ms-4">
                <a href="{{ route('comments.thread', $comment->id) }}" class="text-muted">View thread →</a>
            </div>
        @endif
    @endif
</div>
