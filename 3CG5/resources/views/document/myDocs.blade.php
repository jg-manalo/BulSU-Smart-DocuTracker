<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Documents') }}
        </h2>
    </x-slot>
    <br>
    <br>
    <div class="py-12" style="background-color:  #f8f9fa;">
        <table class="table-auto border border-collapse border-gray-300" align="center">
            <thead class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">UUID</th>
                <th class="border border-gray-300 px-4 py-2">Title</th>
                <th class="border border-gray-300 px-4 py-2">Receiving Department</th>
                <th class="border border-gray-300 px-4 py-2">Communication</th>
                <th class="border border-gray-300 px-4 py-2">Created At</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
            </thead>
            <tbody>
                @foreach($documents as $doc)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2"><a href="{{ route('document.show', ['uuid' => $doc->uuid]) }}">
                                {{ $doc->uuid }}
                            </a></td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doc->title }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doc->recepient_dept }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doc->communication }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doc->created_at }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <form method="POST" action="{{ route('document.deleteEntry',['uuid'=>$doc->uuid]) }}" onsubmit="return confirm('Delete this document?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
     </div>
</x-app-layout>