<!-- <style>
    #documentTable{
        background-color:  #f8f9fa;
    }

    #deleteConfirmModal{
        border-radius: 5px;
        padding: 20px;
        display:none; 
        position:fixed; top:0; 
        left:0;
        width:100%; 
        height:100%; 
        background:rgba(0,0,0,0.5);
    }

    #deleteConfirmation{
        background: #f8f9fa;
        margin:100px auto;
        padding:20px;
        width:400px;
        border-radius:8px;
    }

</style> -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
            {{ __('My Documents') }}
        </h2>
    </x-slot>
    <br>
    <br>
<div class="md:block hidden max-w-6xl px-4 py-12 mx-auto">
    <div class="dark:bg-gray-900 rounded-xl overflow-x-auto bg-white shadow-md">
        <table class="dark:border-gray-700 min-w-full border border-gray-200 rounded-lg table-auto">
            <thead class="bg-gray-50 dark:bg-gray-800 dark:text-gray-200 text-sm font-semibold text-gray-700 uppercase">
                <tr>
                    <th class="dark:border-gray-700 px-6 py-4 text-left border-b border-gray-200">Location</th>
                    <th class="dark:border-gray-700 px-6 py-4 text-left border-b border-gray-200">UUID</th>
                    <th class="dark:border-gray-700 px-6 py-4 text-left border-b border-gray-200">Title</th>
                    <th class="dark:border-gray-700 lg:table-cell hidden px-6 py-4 text-left border-b border-gray-200">Receiving Department</th>
                    <th class="dark:border-gray-700 lg:table-cell hidden px-6 py-4 text-left border-b border-gray-200">Communication</th>
                    <th class="dark:border-gray-700 px-6 py-4 text-left border-b border-gray-200">Created At</th>
                    <th class="dark:border-gray-700 px-6 py-4 text-center border-b border-gray-200">Action</th>
                </tr>
            </thead>
            <tbody class="dark:text-gray-200 text-sm text-gray-800">
                @foreach($documents as $doc)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <td class="dark:border-gray-700 px-6 py-3 border-t border-gray-100">
                            <a href="{{ route('document.logs', ['uuid' => $doc->uuid]) }}">
                                <button class="hover:bg-blue-600 px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-full">
                                    Track
                                </button>
                            </a>
                        </td>
                        <td class="dark:border-gray-700 px-6 py-3 border-t border-gray-100">
                            <a href="{{ route('document.show', ['uuid' => $doc->uuid]) }}" class="dark:text-blue-400 hover:underline text-blue-600" id="doc-{{ $doc->uuid }}">
                                {{ $doc->uuid }}
                            </a>
                        </td>
                        <td class="dark:border-gray-700 px-6 py-3 border-t border-gray-100" id="title-{{ $doc->uuid }}">{{ $doc->title }}</td>
                        <td class="dark:border-gray-700 lg:table-cell hidden px-6 py-3 border-t border-gray-100">{{ $doc->recipient_dept }}</td>
                        <td class="dark:border-gray-700 lg:table-cell hidden px-6 py-3 border-t border-gray-100">{{ $doc->communication }}</td>
                        <td class="dark:border-gray-700 px-6 py-3 border-t border-gray-100">
                            {{ $doc->created_at->format('M d, Y') }}
                        </td>
                        <td class="dark:border-gray-700 px-6 py-3 text-center border-t border-gray-100">
                            <form method="POST" action="{{ route('document.deleteEntry',['uuid'=>$doc->uuid]) }}" id="docDeleteForm-{{ $doc->uuid }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deleteConfirmFirst('{{ $doc->uuid }}')" class="hover:bg-red-600 px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-full">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


        
     <div class="md:hidden block space-y-6">
        @foreach($documents as $doc)
            <div class="bg-white/70 transition-colors dark:bg-gray-900/80 rounded-xl dark:hover:bg-gray-900 dark:text-gray-200 p-4 shadow-[0_0_10px_rgba(255,255,255,0.4)] backdrop-blur-md max-w-[90%] mx-auto">
                <p><strong>UUID:</strong> <a href="{{ route('document.show', ['uuid' => $doc->uuid]) }}" class="hover:underline dark:text-blue-300 font-bold text-blue-800">{{ $doc->uuid }}</a></p>
                <p><strong>Title:</strong> {{ $doc->title }}</p>
                <p><strong>Receiving Dept:</strong> {{ $doc->recipient_dept }}</p>
                <p><strong>Communication:</strong> {{ $doc->communication }}</p>
                <p><strong>Created At:</strong> {{ $doc->created_at }}</p>
                <div class="flex justify-between mt-4">
                    <a href="{{ route('document.logs', ['uuid' => $doc->uuid]) }}">
                        <button class="hover:bg-blue-700 px-4 py-2 font-bold text-white bg-blue-500 rounded-full">Track</button>
                    </a>
                    <form method="POST" action="{{ route('document.deleteEntry',['uuid'=>$doc->uuid]) }}" id="docDeleteForm-{{ $doc->uuid }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteConfirmFirst('{{ $doc->uuid }}')" class="hover:bg-red-700 px-4 py-2 font-bold text-white bg-red-500 rounded-full">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div id="deleteConfirmModal">
        <div id="deleteConfirmation" class="w-fit">
            <h3><strong>Delete Document?</strong></h3>
            <p id="previewText"></p>
            <br>
            <button onclick="submitFormDelete()" class="hover:bg-green-700 px-4 py-2 font-bold text-white bg-green-500 rounded-full" type="button" onclick="confirmFirst()">Confirm</button>
            <button onclick="closeModalDelete()" class="hover:bg-red-700 px-4 py-2 font-bold text-white bg-red-500 rounded-full" type="button" onclick="confirmFirst()">Cancel</button>
            <br>
            <br>
            <p><i>*If you delete this document, all logs would be deleted as well.</i></p>
        </div>
    </div>
</x-app-layout>