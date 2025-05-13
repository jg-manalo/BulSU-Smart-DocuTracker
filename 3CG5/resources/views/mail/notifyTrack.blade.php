<div>
    <!-- Well begun is half done. - Aristotle -->
     Good day, {{ $name }} !
     <br>
     <br>
    BulSU Docutracker would like to keep you updated on the status of your document:
    <br>
    <br>
        Document Title: {{ $title }}
    <br>
        Date Received: {{ $received_date }} 
    <br>
        Received By: {{ $received_by }}
    <br>
        Status: {{ $status }}   
    <br>
        Remarks: {{ $remarks == null ? 'No remarks' : $remarks }}
    <br>
        UUID: {{ $uuid }}
    <br>
    <br>
    <br>
    <br>
        You can track your document using the link below:
    <br>
        URL: <a href="{{ $url }}">{{ $url }}</a>
    <br>
    <br>
    <br>
    <br>
    Thank you!
</div>
