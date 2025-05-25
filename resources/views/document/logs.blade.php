<!-- <style>
    #logs-table-container {
        justify-self: center;
        transform: scale(0.9);
    }
</style> -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
            {{ __('Logs') }}
        </h2>
    </x-slot>
    <br>
    <br>
@auth
<div id="logs-table-container" class="max-w-7xl p-5 mx-auto">
    {{-- Desktop Table --}}
    <div class="md:block dark:bg-gray-900 hidden overflow-x-auto bg-white rounded-lg shadow">
        <table class="dark:border-gray-700 min-w-full border border-gray-200 rounded table-auto">
            <thead class="dark:bg-gray-800 dark:text-gray-200 text-sm font-semibold text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left border-b">UUID</th>
                    <th class="px-4 py-3 text-left border-b">Title</th>
                    <th class="px-4 py-3 text-left border-b">Sender</th>
                    <th class="px-4 py-3 text-left border-b">Sender's Email</th>
                    <th class="px-4 py-3 text-left border-b">Sender's Department</th>
                    <th class="px-4 py-3 text-left border-b">Recipient</th>
                    <th class="px-4 py-3 text-left border-b">Recipient's Email</th>
                    <th class="px-4 py-3 text-left border-b">Receiving Department</th>
                    <th class="px-4 py-3 text-left border-b">Communication</th>
                    <th class="px-4 py-3 text-left border-b">Status</th>
                    <th class="px-4 py-3 text-left border-b">Remarks</th>
                    <th class="px-4 py-3 text-left border-b">Time Stamps</th>
                </tr>
            </thead>
            <tbody class="dark:text-gray-200 text-sm text-gray-800">
                @foreach($logs as $log)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <td class="dark:border-gray-700 px-4 py-3 border-t">{{ $log->uuid }}</td>
                        <td class="dark:border-gray-700 px-4 py-3 border-t">{{ $log->title }}</td>
                        <td class="dark:border-gray-700 px-4 py-3 border-t">{{ $log->sender }}</td>
                        <td class="dark:border-gray-700 px-4 py-3 border-t">{{ $log->sender_email }}</td>
                        <td class="dark:border-gray-700 px-4 py-3 border-t">{{ $log->sender_dept }}</td>
                        <td class="dark:border-gray-700 px-4 py-3 border-t">{{ $log->recipient }}</td>
                        <td class="dark:border-gray-700 px-4 py-3 border-t">{{ $log->recipient_email }}</td>
                        <td class="dark:border-gray-700 px-4 py-3 border-t">{{ $log->recipient_dept }}</td>
                        <td class="dark:border-gray-700 px-4 py-3 border-t">{{ $log->communication }}</td>
                        <td class="dark:border-gray-700 px-4 py-3 border-t">{{ $log->status }}</td>
                        <td class="dark:border-gray-700 px-4 py-3 border-t">{{ $log->remarks }}</td>
                        <td class="dark:border-gray-700 px-4 py-3 border-t">{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Mobile Cards --}}
    <div class="md:hidden px-4 py-8 space-y-4">
        @foreach($logs as $log)
            <div class="dark:bg-gray-900 dark:border-gray-700 rounded-xl p-4 bg-white border border-gray-200 shadow">
                <div class="mb-2 text-xl font-bold text-red-600">
                    {{ $log->title }}
                </div>
                <div class="dark:text-gray-300 space-y-1 text-sm text-gray-600">
                    <p><span class="font-medium"><strong>UUID:</strong></span> {{ $log->uuid }}</p>
                    <p><span class="font-medium"><strong>Sender:</strong></span> {{ $log->sender }}</p>
                    <p><span class="font-medium"><strong>Sender's Email:</strong></span> {{ $log->sender_email }}</p>
                    <p><span class="font-medium"><strong>Sender's Dept:</strong></span> {{ $log->sender_dept }}</p>
                    <p><span class="font-medium"><strong>Recipient:</strong></span> {{ $log->recipient }}</p>
                    <p><span class="font-medium"><strong>Recipient's Email:</strong></span> {{ $log->recipient_email }}</p>
                    <p><span class="font-medium"><strong>Receiving Dept:</strong></span> {{ $log->recipient_dept }}</p>
                    <p><span class="font-medium"><strong>Communication:</strong></span> {{ $log->communication }}</p>
                    <p><span class="font-medium"><strong>Status:</strong></span> {{ $log->status }}</p>
                    <p><span class="font-medium"><strong>Remarks:</strong></span> {{ $log->remarks }}</p>
                    <p><span class="font-medium"><strong>Timestamp:</strong></span> {{ $log->created_at }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endauth



</x-app-layout>

