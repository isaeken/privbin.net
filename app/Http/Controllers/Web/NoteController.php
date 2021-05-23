<?php

namespace App\Http\Controllers\Web;

use App\Enums\Language;
use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $notes = auth()->user()->notes()->orderByDesc('created_at')->paginate();
        return response()->view('web.notes.index', compact('notes'));
    }

    /**
     * @param Request $request
     * @param Note $note
     * @return Response|RedirectResponse
     */
    public function show(Request $request, Note $note): Response|RedirectResponse
    {
        if ($note->isExpired()) {
            return $this->expired();
        }

        if (! $note->gate($request)) {
            return response()->redirectToRoute('notes.auth', ['note' => $note]);
        }

        return response()->view('web.notes.show', compact('note'));
    }

    /**
     * @param Request $request
     * @param Note $note
     * @return Response|Application|ResponseFactory
     */
    public function raw(Request $request, Note $note): Response|Application|ResponseFactory
    {
        if ($note->isExpired()) {
            return $this->expired();
        }

        if (! $note->gate($request)) {
            return response('Authentication token required for this note.', 401, ['Content-Type' => 'text/txt']);
        }

        return response($note->content, 200, [
            'Content-Type' => 'text/txt',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    /**
     * @param Request $request
     * @param Note $note
     * @return Response|RedirectResponse
     */
    public function embed(Request $request, Note $note): Response|RedirectResponse
    {
        if ($note->isExpired()) {
            return $this->expired();
        }

        if (! $note->gate($request)) {
            return response()->redirectToRoute('notes.auth', ['note' => $note]);
        }

        $theme = 'vs-dark';
        $lines = collect();

        if ($request->has('theme')) {
            if (in_array($request->input('theme'), ['vs', 'vs-dark', 'hc-black'])) {
                $theme = $request->input('theme');
            }
        }

        if ($request->has('lines') && is_array($request->get('lines')) && count($request->get('lines')) > 0) {
            foreach ($request->get('lines') as $line) {
                if (! is_numeric($line)) {
                    abort(400);
                }

                $lines->add(intval($line));
            }
        }

        return response()->view('web.notes.embed', compact('note', 'theme', 'lines'), 200, [
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    /**
     * @param Request $request
     * @param Note $note
     * @return JsonResponse
     */
    public function makeEmbedUrl(Request $request, Note $note): JsonResponse
    {
        $theme = 'vs-dark';
        $lines = collect();

        if ($request->has('theme')) {
            if (in_array($request->input('theme'), ['vs', 'vs-dark', 'hc-black'])) {
                $theme = $request->input('theme');
            }
        }

        if ($request->has('lines') && mb_strlen(trim($request->get('lines'))) > 0) {
            foreach (explode(',', trim($request->get('lines'))) as $line) {
                $line = intval($line);
                if ($line < 1 || $line > $note->lines->count()) {
                    abort(400, 'Invalid line number provided.');
                }

                $lines->add($line);
            }
        }

        $str = '';
        foreach ($lines as $line) {
            $str .= sprintf('&lines[]=%s', $line);
        }

        $url = route('notes.show.embed', $note) . sprintf('?theme=%s%s', $theme, $str);
        $str = '';
        $i = 0;
        foreach ($lines as $line) {
            $i++;
            $separator = $i < count($lines) ? ',' : '';
            $str .= sprintf('%s%s', $line, $separator);
        }

        $tag = '<div privbin-note="' . $note->slug . '" privbin-theme="' . $theme . '" privbin-lines="[' . $str . ']"></div>';

        return response()->json([
            'url' => $url,
            'script_url' => route('assets.embed'),
            'embed_tag' => $tag,
        ], 200, [
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    /**
     * @param Request $request
     * @param Note $note
     * @return Response|RedirectResponse|Application|ResponseFactory
     */
    public function destroy(Request $request, Note $note): Response|RedirectResponse|Application|ResponseFactory
    {
        abort_unless($note->user_id == auth()->id(), 403);

        if ($note->isExpired()) {
            return $this->expired();
        }

        if (! $note->gate($request)) {
            return response()->redirectToRoute('notes.auth', ['note' => $note]);
        }

        $note->delete();
        return back();
    }

    /**
     * @param Request $request
     * @param Note $note
     * @return Response|RedirectResponse
     */
    public function auth(Request $request, Note $note): Response|RedirectResponse
    {
        if ($request->getMethod() === 'POST') {
            if ($note->gate()) {
                return response()->redirectToRoute('notes.show', $note);
            }

            return response()->redirectToRoute('notes.auth', ['note' => $note])->withErrors([__('Invalid password.')]);
        }

        return response()->view('web.notes.auth', compact('note'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'nullable|sometimes|string|max:255',
            'password' => 'nullable|sometimes|string|max:255',
            'language' => 'required|in:' . implode(',', Language::asArray()),
            'expire' => 'required',
            'content' => 'required|min:3',
        ]);

        $note = Note::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'title' => $request->input('title'),
            'password' => $request->input('password'),
            'language' => $request->input('language'),
            'expire' => $request->input('expire'),
            'content' => $request->input('content'),
        ]);

        return response()->redirectToRoute('notes.show', $note->slug);
    }

    /**
     * @return Response
     */
    public function expired(): Response
    {
        return response()->view('web.notes.expired', [], 404);
    }
}
