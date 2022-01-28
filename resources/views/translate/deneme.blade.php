<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deneme') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">                             
               <!-- component -->

               <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Teams</div>
                                </th>                                                                                                     
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach ($teams as $team )   
                                <tr>
                                    <td class="p-2 whitespace-nowrap">                                                  
                                        <div class="flex items-center">{{$team[0]}}</div>
                                    </td> 
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>



               <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Home</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Away</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Week</div>
                                </th>                                                                          
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                           
                            @foreach ($fixture as $item )   
                            <tr>
                              
                                <td class="p-2 whitespace-nowrap">                                                  
                                    <div class="flex items-center">{{$item[0][0]}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{$item[1][0]}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{$item[2]}}</div>
                                </td>                              
                            </tr>                            
                        @endforeach
                        </tbody>
                    </table>
              
              

            </div>
        </div>
    </div>
</x-app-layout>
