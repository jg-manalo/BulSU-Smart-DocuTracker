<style>
    #container-qrGen {
        padding: 20px;
        margin: 20px auto;
        display:grid;
        justify-self: center;
        transform: scale(0.9);
    }
    #qrForm {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
    }
    #confirmModal {
        background-color: white;
        border-radius: 5px;
        padding: 20px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Generate QR Code') }}
        </h2>
    </x-slot>

    <div id="container-qrGen">
        <div class="py-12">
            <form method="POST" action="{{ route('document.store') }}" id="qrForm">
                @csrf
                <label for="title" class="">Document: </label>
                <input type="text" name="title" placeholder="Document Title" required id="title"><br>

                <label for="recepient" class="">Recepient: </label>
                <input type="text" id="sender" name="sender" placeholder="Sender Name" value="{{ Auth::user()->name }}"required readonly><br>
                
                <label for="" class="email">Sender's Email: </label>
                <input type="text" name="sender_email" placeholder="Sender Email" id = "email" value="{{ Auth::user()->email }}" required readonly><br>
                
                <label for="" class="sender_dept">Sender's Department</label>
                <input type="text" name="sender_dept" id="sender_dept" placeholder="Sender Email" value="{{ Auth::user()->department }}" required readonly><br>
                
                <select name="recepient_dept" id="department" placeholder="Recepient Department">
                    <option value="" disabled selected>Receiving Department</option>
                    <option value="College of Engineering">College of Engineering</option>
                    <option value="Office of The President">Office of the President</option>
                    <option value="Accounting Office">Accounting Office</option>
                    <option value="Office of The Chancellor">Office of The Chancellor</option>
                </select>    
                <br>
                Communication: 
                <br>
                <input type="radio" name="communication" id="internal" value="IC" required>
                <label for="internal">Internal Communication</label> <br>
                <input type="radio" name="communication" id="external" value="EC" required>
                <label for="external">External Communication</label>
                <br>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" type="button" onclick="confirmFirst()" >Generate QR Code</button>
            </form>
        </div>
        
        <div id="confirmModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5);">
            <div style="background:white; margin:100px auto; padding:20px; width:400px; border-radius:8px;">
                <h3><strong>Confirm Submission?</strong></h3>
                <p id="previewText"></p>
                <button onclick="submitForm()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="button" onclick="confirmFirst()">Confirm</button>
                <button onclick="closeModal()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full" type="button" onclick="confirmFirst()">Cancel</button>
            </div>
        </div>
    </div>
    

</x-app-layout>