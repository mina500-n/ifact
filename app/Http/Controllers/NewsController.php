<?php

namespace App\Http\Controllers;

use App\Models\NewsCheck;
use App\Services\AIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    protected AIService $ai;

    public function __construct(AIService $ai)
    {
        $this->ai = $ai;
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content'    => 'required|min:20',
            'source_url' => 'nullable|url',
        ]);

        // Check AI service is reachable
        if (!$this->ai->ping()) {
            return back()
                ->withInput()
                ->withErrors(['ai' => 'AI service is offline. Please try again later.']);
        }

        // Call AI API
        $aiResponse = $this->ai->analyze($request->content);

        if (!$aiResponse['success']) {
            return back()
                ->withInput()
                ->withErrors(['ai' => $aiResponse['error']]);
        }

        $data = $aiResponse['data'];

        // Save to database
        $check = NewsCheck::create([
            'user_id'          => Auth::id(),
            'content'          => $request->content,
            'source_url'       => $request->source_url,
            'result'           => $data['result'],
            'credibility_score'=> $data['credibility_score'],
            'sentiment'        => $data['sentiment'],
            'ai_details'       => $data,
        ]);

        return redirect()->route('news.show', $check->id)
                         ->with('success', 'Analysis complete.');
    }

    public function show(NewsCheck $newsCheck)
    {
        abort_if($newsCheck->user_id !== Auth::id(), 403);
        return view('news.show', compact('newsCheck'));
    }

    public function history()
    {
        $checks = NewsCheck::where('user_id', Auth::id())
                           ->latest()
                           ->paginate(10);
        return view('news.history', compact('checks'));
    }
}
