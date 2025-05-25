<!-- <style>
    #update-panel{
        display:flex;
        gap: 5%;
        justify-self: center;
    }

    #statusConfirmModal{
        border-radius: 5px;
        padding: 20px;
        display:none; 
        position:fixed; top:0; 
        left:0;
        width:100%; 
        height:100%; 
        background:rgba(0,0,0,0.5);    
    }
    
    #statusConfirmation{
        background: #f8f9fa;
        margin:100px auto;
        padding:20px;
        width:400px;
        border-radius:8px;
    }

    #statusError{
        color: red;
    }
</style> -->
<x-app-layout>

    @auth
    <div class="py-12">
        <div id="update-panel" class="sm:flex-row flex flex-col">
            <div class="m-5 px-4 bg-white/60 dark:bg-gray-600/50 text-crimson dark:text-white max-w-lg p-2 sm:py-20 shadow-[0_0_10px_rgba(255,255,255,0.4)] backdrop-blur-md rounded-lg justify-center">
                <h1 class="mb-5 font-bold">Update Document Status</h1>
                <p class="my-3"><strong>Document Title:</strong> {{ $document->title }}</p>
                <p class="my-3"><strong>Created By:</strong> {{ $document->sender }}</p>
                <p class="my-3"><strong>Email:</strong> {{ $document->sender_email }}</p>
                <p class="my-3"><strong>Department:</strong> {{ $document->sender_dept }}</p>
                <p class="my-3"><strong>Destination Department:</strong> {{ $document->recipient_dept }}</p>
                <p class="my-3"><strong>Generation Date:</strong> {{ $document->created_at }}</p>
                <p class="my-3"><strong>Status:</strong> {{ $log?->status ?? 'No status' }}</p>
            </div>
            <div class="m-5 text-crimson px-4 bg-white/60 dark:bg-gray-600/50 dark:text-white max-w-lg p-4 shadow-[0_0_10px_rgba(255,255,255,0.4)] backdrop-blur-md rounded-lg justify-center">
                <form method="POST" id="statusSubmitForm" action="{{ route('document.updateStatus', $document->uuid) }}">
                    @csrf
                    <label for="recipient"><strong>Document is being received by:</strong></label>
                    <input type="text" id="recipient" name="recipient" value="{{ Auth::user()->name }}" readonly
                    class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-sm border-transparent rounded-full shadow-sm"
                    >
                    <br>


                    <label for="recipient_dept"><strong>Recipient Department:</strong></label>
                    <input type="text" id="recipient_dept" name="recipient_dept" value="{{ Auth::user()->department}}" readonly
                    class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-sm border-transparent rounded-full shadow-sm"
                    >
                    <br>
                    
                    <label for="recipient_email"><strong>Recipient Email:</strong></label>
                    <input type="text" id="recipient_email" name="recipient_email" value="{{ Auth::user()->email}}" readonly
                    class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-sm border-transparent rounded-full shadow-sm">
                    <br>

                    <label for="status"><strong>Status Update:</strong></label>
                    <select name="status" id="status" required
                    class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-sm border-transparent rounded-full shadow-sm"
                    >
                        <option value="Pending" {{ $document->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Processing" {{ $document->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="Done" {{ $document->status == 'Done' ? 'selected' : '' }}>Done</option>
                        <option value="Returned" {{ $document->status == 'Returned' ? 'selected' : '' }}>Returned</option>
                    </select>
                    <div id="statusError"></div>

                    <label for="remarks"><strong>Remarks:</strong></label>
                    <br>
                    <textarea name="remarks" id="remarks" maxlength="255" placeholder=""
                    class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-sm border-transparent rounded-full shadow-sm"
                    ></textarea>
                    <br>
                    <br>
                    <button type="button" onclick="validateStatusForm()" class="hover:bg-red-600 bg-crimson px-4 py-2 font-bold text-white rounded-full">Update Status</button>

                    @if(session('success'))
                        <p style="color:green;">{{ session('success') }}</p>
                    @endif

                </form>
            </div>
        </div> 
    </div>
    <div id="statusConfirmModal">
        <div id="statusConfirmation">
            <h3><strong>Confirm Submission?</strong></h3>
            <p id="previewStatusConfirm"></p>
            <button onclick="statusSubmitForm()" class="hover:bg-green-700 px-4 py-2 font-bold text-white bg-green-500 rounded-full" type="button">Confirm</button>
            <button onclick="statusCloseModal()" class="hover:bg-red-700 px-4 py-2 font-bold text-white bg-red-500 rounded-full" type="button">Cancel</button>
        </div>
    </div>
    @endauth
</x-app-layout>