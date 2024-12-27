<x-app-layout>
    @push('styles')
        <style>
            .close-image {
                background-color: red;
                color: white;
                border: none;
                padding: 5px;
                border-radius: 5px;
                cursor: pointer;
                top: 5px;
                right: 5px;
            }

            .preview-image {
                height: 100%;
            }

            .space-preview-image {
                height: 200px;
                display: flex;
                justify-description: center;
                align-items: center;
            }

            .input-description {
                resize: none;
            }
        </style>

    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('product.store') }}" class="mt-6 space-y-6 p-4"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <x-input-label for="image" :value="__('Image')" />
                            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" required/>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="position-relative space-preview-image">
                            <button type="button" class="close-image position-absolute hidden"><i class="fas fa-x"></i></button>
                            <img id="preview-image" src="{{asset('images/no-image.png')}}" alt="preview image" class="preview-image" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            autocomplete="name" required/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea name="description" id="description" class="input-description mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" cols="30" rows="5" required></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="number" class="mt-1 block w-full"
                            autocomplete="price" required/>
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="stock" :value="__('Stock')" />
                        <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full"
                            autocomplete="stock" required/>
                        <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="supplier_email" :value="__('Supplier email')" />
                        <x-text-input id="supplier_email" name="supplier_email" type="email" class="mt-1 block w-full"  />
                        <x-input-error class="mt-2" :messages="$errors->get('supplier_email')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                        <a href="{{route('dashboard')}}" class="btn btn-danger inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#image').change(function () {
                    const file = this.files[0];
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        $('#preview-image').attr('src', e.target.result);
                        $('.close-image').removeClass('hidden');
                    }

                    reader.readAsDataURL(file);
                });

                $('.close-image').click(function () {
                    $('#preview-image').attr('src', '{{asset('images/no-image.png')}}');
                    $('.close-image').addClass('hidden');
                    $('#image').val('');
                });
            });
        </script>
    @endpush
</x-app-layout>
