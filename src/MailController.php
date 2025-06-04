<?php

declare(strict_types=1);

namespace Tkeer\Mailbase;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class MailController extends Controller
{
    public function index()
    {
        $mails = Mailbase::query()->latest('sent_at')->paginate(20);

        return view('mailbase::index', ['mails' => $mails]);
    }

    public function show(Mailbase $mailbase)
    {
        $mailbase->update(['is_read' => 1]);

        return response()->json($mailbase);
    }

    /**
     * Clear all emails from the database
     *
     * @return JsonResponse
     */
    public function clear(): JsonResponse
    {
        try {
            Mailbase::truncate();

            return response()->json([
                'success' => true,
                'message' => 'All emails have been cleared successfully.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear emails: ' . $e->getMessage()
            ], 500);
        }
    }
}