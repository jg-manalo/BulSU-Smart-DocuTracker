<!-- <style>
    #container-qrGen {
        padding: 20px;
        margin: 20px auto;
        display:grid;
        justify-self: center;
        transform: scale(0.9);
    }
    #qrForm {
        border-radius: 24px;
    }
    #confirmModal {
        border-radius: 5px;
        padding: 20px;
        display:none; 
        position:fixed; top:0; 
        left:0;
        width:100%; 
        height:100%; 
        background:rgba(0,0,0,0.5);    
    }

    #confirmation{
        background: #f8f9fa;
        margin:100px auto;
        padding:20px;
        width:400px;
        border-radius:8px;
    }

    #documentTitleError, #departmentError, #communicationError{
        color: red;
    }
</style> -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
            {{ __('Generate QR Code') }}
        </h2>
    </x-slot>

    <div id="container-qrGen">
        <div class="text-crimson dark:text-white flex justify-center w-full py-2 font-semibold bg-transparent">
            <form method="POST" action="{{ route('document.store') }}" id="qrForm"
            class="bg-white/50 dark:bg-gray-600/50 w-full max-w-lg p-10 shadow-[0_0_10px_rgba(255,255,255,0.4)] backdrop-blur-md"
            >
                <h1 class="text-center">Document Details</h1>
                @csrf
                <label for="title" class="">Document: </label><br>
                <input type="text" name="title" required id="title" 
                class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-lg border-transparent rounded-full shadow-sm"
                ><br>
                <div id="documentTitleError"></div>
                
                <label for="sender" class="">Recipient: </label><br>
                <input type="text" id="sender" name="sender" placeholder="Sender Name" value="{{ Auth::user()->name }}"required readonly 
                class="text-crimson dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 bg-gray-200/50 w-full max-w-xl my-1 text-lg border-transparent rounded-full shadow-sm"
                ><br>
                
                <label for="email" class="email">Sender's Email: </label><br>
                <input type="text" name="sender_email" placeholder="Sender Email" id = "email" value="{{ Auth::user()->email }}" required readonly
                class="text-crimson dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 bg-gray-200/50 w-full max-w-xl my-1 text-lg border-transparent rounded-full shadow-sm"
                ><br>
                
                <label for="sender_dept" class="sender_dept">Sender's Department:</label><br>
                <input type="text" name="sender_dept" id="sender_dept" placeholder="Sender Email" value="{{ Auth::user()->department }}" required readonly
                class="text-crimson dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 bg-gray-200/50 w-full max-w-xl my-1 text-lg border-transparent rounded-full shadow-sm"
                ><br>
                
                <label for="department" class="">Destination: </label><br>
                <select name="recipient_dept" id="department" placeholder="Recipient Department"
                class="text-crimson dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 bg-gray-200/50 w-full max-w-xl my-1 text-lg border-transparent rounded-full shadow-sm"
                >
                    <option value="" disabled selected>Destination Department</option>
                    <option value="College of Engineering">College of Engineering</option>
                    <option value="Office of The President">Office of the President</option>
                    <option value="Accounting Office">Accounting Office</option>
                    <option value="Office of The Chancellor">Office of The Chancellor</option>
                    <option value="Office of The VPAA">Office of The VPAA</option>
                </select>    
                <div id="departmentError"></div>
                <br>
                Communication: 
                <br>
                <input type="radio" name="communication" id="internal" value="IC" required class="text-red-600">
                <label for="internal">Internal Communication (IC)</label> <br>
                <input type="radio" name="communication" id="external" value="EC" required class="text-red-600">
                <label for="external">External Communication (EC)</label>
                <div id="communicationError"></div>
                <br>
                <button class="hover:bg-red-600 bg-crimson px-4 py-2 font-bold text-white transition rounded-full" type="button" onclick="validateForm()" >Generate QR Code</button>
            </form>
        </div>
        
        <div id="confirmModal" class="w-1/2">
            <div id="confirmation">
                <h3><strong>Confirm Submission?</strong></h3>
                <p id="previewText"></p>
                <button onclick="submitForm()" class="hover:bg-red-700 px-4 py-2 font-bold text-white bg-red-500 rounded-full" type="button">Confirm</button>
                <button onclick="closeModal()" class="hover:bg-red-700 px-4 py-2 font-bold text-white bg-red-500 rounded-full" type="button">Cancel</button>
            </div>
        </div>
    </div>
    

</x-app-layout>