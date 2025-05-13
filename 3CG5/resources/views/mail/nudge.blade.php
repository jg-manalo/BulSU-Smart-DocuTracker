<div>
    <!-- He who is contented is rich. - Laozi -->
     <p>Hi <strong>{{ $name }}</strong> !</p>
     <br>
     <br>
     <p>Have you ever received the document <strong>{{ $title }}</strong>?</p>
     <p>Tracking Details: <a href="{{ $url }}">{{ $url }}</a></p>
     <p>We would like to remind you that it is still <strong>{{ $status }}</strong> for <strong>{{ $daysSince }}</strong></strong> days.</p>
     <br>
     <br>
     <p>Please contact the following:</p>
     <br>
     @if($received_by != null)
        <p><strong>{{ $received_by }}</strong></p>
        <a href="mailto:{{ $receiving_email }}"><strong>{{ $receiving_email }}</strong></a>
        <br>
        <br>
     @else
     @foreach($users as $user)
        @if($recepient_department === $user->department)
            <p><strong>{{ $user->name }}</strong></p>
            <a href="mailto:{{ $user->email }}?subject={{ $title }}"><strong>{{ $user->email }}</strong></a>
            <br>
            <br>
        @endif
     @endforeach
     @endif
    <p>Thank You!</p>   
</div>
