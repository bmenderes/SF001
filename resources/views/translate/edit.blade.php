<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Translate') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">                             
               <!-- component -->
                <section class="antialiased bg-gray-100 text-gray-600 h-screen px-4">
                    @if (Session::has('message'))
                    <div class="text-left font-medium text-green-500"> {{Session::get('message')}}</div>
                    
                    @endif
                    <div class="flex flex-col justify-center h-full">
                        <!-- Table -->
                        <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                            <header class="px-5 py-4 border-b border-gray-100">
                                <h2 class="font-semibold text-gray-800">Translator Update</h2>
                            </header>
                            <div class="p-3">
                                <div class="overflow-x-auto">
                                    <table class="table-auto w-full">
                                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                            <tr>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-left">Id</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-left">String</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-left">Target</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-left">Result</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-left">Update</div>
                                                </th>                                             
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm divide-y divide-gray-100">
                                            <form action="{{route('translations.update',$translate->id)}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="id" value="{{$translate->id}}">
                                                <tr>
                                                    <td class="p-2 whitespace-nowrap">                                                  
                                                        <div class="flex items-center">{{$translate->id}}</div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="text-left">{{$translate->string}}</div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="text-left font-medium text-green-500">{{$translate->target}}</div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap ">
                                                        <input type="flex items-center" name="result" value="{{$translate->result}}">
                                                    </td> 
                                                    <td>
                                                        <button type="submit" class="text-green-500">Edit</button>
                                                    </td>
                                                </tr>
                                                
                                        </form>
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
