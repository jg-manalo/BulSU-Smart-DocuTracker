<?php

namespace App\Http\Controllers;
use App\Models\Document;
use App\Models\DocumentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\MailableName;
use App\Mail\Nudge;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isNull;

class DocumentLogController extends Controller
{
    
      // Update document status
      public function updateStatus(Request $request, $uuid)
      {    
        $validate = $request->validate([
            'recepient' => 'required|string|max:255',
            'recepient_email' => 'required|email|max:255',
            'recepient_dept' => 'required|string|max:255',
            'status' => 'required|in:Pending,Processing,Done,Returned',
            'remarks' => 'nullable|string|max:255',
        ]);
        DB::beginTransaction();
          
        try {
                $document = Document::where('uuid', $uuid)->firstOrFail();
              
                $logs = DocumentLog::create([
                    'uuid' => $document->uuid,
                    'title' => $document->title,
                    'sender' => $document->sender,
                    'sender_email' => $document->sender_email,
                    'sender_dept' => $document->sender_dept,
                    'recepient' => $validate['recepient'],
                    'recepient_email' => $validate['recepient_email'],
                    'recepient_dept' => $document->recepient_dept,
                    'communication' => $document->communication,
                    'status' => $validate['status'],
                    'remarks' => $validate['remarks'],
                ]);
                
                
                DB::commit();
                Mail::to($document->sender_email)->send(new MailableName($logs));
                return redirect()->route('document.logs', $logs->uuid)->with('success', 'Document status updated successfully.');
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Failed to log changes', 'message' => $e->getMessage()], 500);
            }
      }

      public function showLogsEdit($uuid){
        $logs = DocumentLog::orderByDesc('created_at')
        ->where('uuid', $uuid)
        ->get();
        if ($logs->isEmpty()) {
            return redirect()->route('document.logs')->with('error', 'No logs found for this document.');
        }
        return view('document.logs', compact('logs'));
      }

      public function showLogFromSearch(Request $request)
      {
        $validate = $request->validate([
            'uuid' => 'required|string|max:255',
        ]);
        $logs = DocumentLog::orderByDesc('created_at')->where('uuid', $validate['uuid'])->get();

        if( $logs->isEmpty()) {
            return redirect()->route('document.logs')->with('error', 'No logs found for this document.');
        }
        return view('document.logs',['uuid' => $validate['uuid']] ,compact('logs'))->with('success', 'Logs found for this document.');
      }

      public static function nudgeDocument()
      {
          $logs = DocumentLog::whereIn('status',['Pending', 'Returned'])->latest()->get();


          if(!$logs->isEmpty()){
              $hashMap = $logs->groupBy('uuid')->map(function ($items) {
                return $items->first();
              });
              $needsNotification = $hashMap -> toArray();
  
              foreach($needsNotification as $item){
                  $document = Document::where('uuid',$item['uuid'])->firstOrFail();
                //   ()

                  if ($document->last_nudge_sent_at !== null ){
                    $timediff = abs(Carbon::now()->diffInDays($document->last_nudge_sent_at));
                    echo $timediff;
                    if($timediff <= 1.00){
                      continue;
                    }
                  }
                  
                  $statusTimeDiff = abs(Carbon::now()->diffInDays($item['created_at']));
                  $threeDays = 3;
                  $isOverDue = $statusTimeDiff >= $threeDays;
                  if ($isOverDue) {
                    Mail::to($item['sender_email'])->send(new Nudge($item));
                    $document->update(['last_nudge_sent_at' => now()]);
                    $document->save();
                    echo $item['sender'];
                  }
              }
          }  
        return view('dashboard');
       
      }
      public function view($uuid){
        $document = Document::where('uuid', $uuid)->firstOrFail();
        $log = DocumentLog::where('uuid', $uuid)->latest()->first();
        return view('document.view', compact('document', 'log')); 
    }
}
