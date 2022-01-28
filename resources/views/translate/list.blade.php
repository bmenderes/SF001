<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Translate List') }}
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
                                <h2 class="font-semibold text-gray-800">Translator</h2>
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
                                                    <div class="font-semibold text-center">Result</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-center">Update</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm divide-y divide-gray-100">
                                            @foreach ($translate as $item )   
                                            <tr>
                                                <td class="p-2 whitespace-nowrap">
                                                  
                                                    <div class="flex items-center">{{$item->id}}
                                                        
                                                    </div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">{{$item->string}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left font-medium text-green-500">{{$item->target}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text text-center">{{$item->result}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                    <form action="#" method="post">
                                                        @csrf
                                                        @method('PUT') 
                                                            <a href="{{route('translations.edit',$item->id)}}" class="bg-blue-200 hover:bg-blue-600 p-2 rounded-t-sm ">Update</a>
                                                    </form>
                                                  
                                                </td>
                                               
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$translate->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
