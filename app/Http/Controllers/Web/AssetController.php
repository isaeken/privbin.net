<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AssetController extends Controller
{
    /**
     * @return Response|Application|ResponseFactory
     */
    public function embed(): Response|Application|ResponseFactory
    {
        $base_url = url('/');
        $javascript = <<<JS
\$('[privbin-note]').each(function () {
        let note = \$(this).attr('privbin-note');
        let lines = \$(this).attr('privbin-lines');
        let theme = \$(this).attr('privbin-theme');

        if (typeof lines !== 'undefined' && lines !== false) {
            lines = JSON.parse(lines);
        }
        else {
            lines = [];
        }

        if (! (typeof theme !== 'undefined' && theme !== false)) {
            theme = 'vs-dark';
        }

        let url = '$base_url/notes/' + note + '/embed?theme=' + theme;
        lines.forEach(function (line) {
            url += '&lines[]=' + line;
        });

        fetch(url)
            .then((response) => response.text())
            .then((html) => {
                \$(this).html(html);
            })
            .catch((error) => {
                console.warn(error);
            });
    });
JS;
        return response($javascript, 200, [
            'Content-Type' => 'application/javascript',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }
}
