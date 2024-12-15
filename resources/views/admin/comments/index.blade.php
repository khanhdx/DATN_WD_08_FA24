@extends('admin.layouts.master')

@section('title')
    Quản lý bình luận bài viết
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">Bình luận bài đăng</h3>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nội dung</th>
                                <th>Người bình luận</th>
                                <th>Bài viết</th>
                                {{-- <th>Trạng thái</th> --}}
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($comments as $comment)
                                <tr>
                                    <td>{{ $loop->iteration + ($comments->currentPage() - 1) * $comments->perPage() }}</td>
                                    <td>{{ $comment->content }}</td>
                                    <td>{{ $comment->user->name ?? 'Ẩn danh' }}</td>
                                    <td>
                                        {{-- <a href="{{ route('show', $comment->post->id ?? '#') }}" target="_blank"> --}}
                                            {{ $comment->post->title ?? 'Không có tiêu đề' }}
                                    </td>
                                    {{-- <td>
                                        <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-control" onchange="this.form.submit()">
                                                <option value="pending"
                                                    {{ $comment->status == 'pending' ? 'selected' : '' }}>Chờ phê duyệt
                                                </option>
                                                <option value="approved"
                                                    {{ $comment->status == 'approved' ? 'selected' : '' }}>Phê duyệt
                                                </option>
                                                <option value="hidden"
                                                    {{ $comment->status == 'hidden' ? 'selected' : '' }}>Ẩn</option>
                                            </select>
                                        </form>
                                    </td> --}}
                                    <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <!-- Nút xóa -->
                                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa bình luận này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Không có bình luận nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Phân trang -->
        <div class="d-flex justify-content-center">
            {{ $comments->links() }}
        </div>
    </div>
@endsection
