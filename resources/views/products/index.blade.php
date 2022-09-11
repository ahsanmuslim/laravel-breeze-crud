<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <a href="/products/create"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Product</button></a>
                    
                    @if (session()->has('message'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                        <span class="font-medium">Success ! </span>{{ session('message') }}
                    </div>
                    @endif
                    
                    <div class="overflow-x-auto relative">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        No
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Product name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Category
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Price
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->count() > 0)
                                    @foreach ($products as $product)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $product->name }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $product->category }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $product->price }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <a href="/products/{{ $product->id }}/edit">
                                                <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-yellow-500 text-white rounded-full">Edit</span>
                                            </a>
                                            <form action="/products/{{ $product->id }}" method="post" class="inline"
                                                @csrf
                                                @method('delete')
                                                <button type="submit">
                                                    <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 text-white rounded-full tbl-hapus">Delete</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach    
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">Data product not found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const tombolHapus = document.querySelectorAll('.tbl-hapus');
        // console.log(tombolHapus);
        tombolHapus.forEach(tbl => {
            tbl.addEventListener('click', function(e) {
                var form =  this.closest('form');

                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda Yakin ?',
                    text: "Data yang Anda hapus tidak dapat di Recovery !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Saya yakin !'
                }).then((willDelete) => {
                    if (willDelete.value) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    @endpush

</x-app-layout>

