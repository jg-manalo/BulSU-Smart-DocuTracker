<style>
    #detail_container{
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        margin: 20px auto;
        width: 80%;
        display: flex;
        gap: 20%;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Document Details') }}
        </h2>
    </x-slot>
    
    <div class="py-4" id="detail_container">
        <a href="{{ route('dashboard') }}" class="w3-large"><i class="fa fa-home w3-large"></i></a>
        <div class="py-4">
            <p><strong>Document Title:</strong> {{ $document->title }}</p>
            <p><strong>Created By:</strong> {{ $document->sender }}</p>
            <p><strong>Email:</strong> {{ $document->sender_email }}</p>
            <p><strong>Department:</strong> {{ $document->sender_dept }}</p>
            <p><strong>Receiving Department:</strong> {{ $document->recepient_dept }}</p>
            <p><strong>Communication:</strong> {{ $document->communication }}</p>
            <p><strong>Generation Date:</strong> {{ $document->created_at }}</p>
        </div>

        <div>
            @if($document->qr_code_path)
            <h3><strong>Download This QR CODE:</strong></h3>
                <img src="{{ asset('storage/' . $document->qr_code_path) }}" width="200">
                <p><strong>Document UUID: {{ $document->uuid }}</strong></p>
                <button onclick="copyUUID()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">COPY UUID</button>
                <a href="{{ asset('storage/' . $document->qr_code_path) }}" download="{{ $document->uuid }}".png>
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">DOWNLOAD</button>
                </a>
            @endif
        </div>
    </div>
    
   
</x-app-layout>