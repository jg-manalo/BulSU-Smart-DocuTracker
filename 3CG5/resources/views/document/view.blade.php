<style>
    #update-panel{
        display:flex;
        gap: 5%;
        justify-self: center;
    }
</style>
<x-app-layout>

    @auth
    <div class="py-12">
        <div class="px-4 mb-4" style="background-color: #f8f9fa; border-radius: 5px; padding: 20px;">
            <h1>Update Document Status</h1>
        </div>

        <div id="update-panel">
            <div class="px-4" style="background-color: #f8f9fa; border-radius: 5px; padding: 20px; margin-bottom: 20px;">
                <p><strong>Document Title:</strong> {{ $document->title }}</p>
                <p><strong>Created By:</strong> {{ $document->sender }}</p>
                <p><strong>Email:</strong> {{ $document->sender_email }}</p>
                <p><strong>Department:</strong> {{ $document->sender_dept }}</p>
                <p><strong>Receiving Department:</strong> {{ $document->recepient_dept }}</p>
                <p><strong>Generation Date:</strong> {{ $document->created_at }}</p>
                <p><strong>Status:</strong> {{ $log?->status ?? 'No status' }}</p>
            </div>
            <div class="px-4" style="background-color: #f8f9fa; border-radius: 5px; padding: 20px;">
                <form method="POST" action="{{ route('document.updateStatus', $document->uuid) }}">
                    @csrf
                    <label for="recepient"><strong>Document is being received by:</strong></label>
                    <input type="text" id="recepient" name="recepient" value="{{ Auth::user()->name }}" readonly>
                    <br>


                    <label for="recepient_dept"><strong>Recepient Department:</strong></label>
                    <input type="text" id="recepient_dept" name="recepient_dept" value="{{ Auth::user()->department}}" readonly>
                    <br>
                    
                    <label for="recepient_email"><strong>Recepient Email:</strong></label>
                    <input type="text" id="recepient_email" name="recepient_email" value="{{ Auth::user()->email}}" readonly>
                    <br>

                    <label for="status"><strong>Status Update:</strong></label>
                    <select name="status" id="status" required>
                        <option value="Pending" {{ $document->status == 'Pending' ? 'selected' : '' }} disabled selected>Pending</option>
                        <option value="Processing" {{ $document->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="Done" {{ $document->status == 'Done' ? 'selected' : '' }}>Done</option>
                        <option value="Returned" {{ $document->status == 'Returned' ? 'selected' : '' }}>Returned</option>
                    </select>
                    <br>

                    <label for="remarks"><strong>Remarks:</strong></label>
                    <br>
                    <textarea name="remarks" id="remarks" maxlength="255" placeholder="(Optional)"></textarea>
                    <br>
                    <br>
                    <button type="submit"  class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">Update Status</button>

                    @if(session('success'))
                        <p style="color:green;">{{ session('success') }}</p>
                    @endif

                </form>
            </div>
        </div>
       
    </div>
   


    @endauth
</x-app-layout>