<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Produc Management') }}
            </h2>

            <a href="{{ route('product.create') }}" class="btn btn-primary">Create Post</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><img src="{{ !empty($post->image) ? Storage::url($post->image) : asset('images/no-image.png') }}" alt="" width="25"></td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Show</a>
                                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-danger delete-button" data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal" data-postid="{{ $post->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Modal xác nhận xóa -->
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">
                                    Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this post?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form id="deletepostForm" method="POST" action="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 my-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                var deleteForm = $('#deletepostForm');

                $('.delete-button').on('click', function() {
                    var postId = $(this).data('postid');
                    console.log(postId);
                    var url = '{{ route('post.destroy', ':id') }}';
                    deleteForm.attr('action', url.replace(':id', postId));
                });
            });
        </script>
    @endpush
</x-app-layout>
