require('./bootstrap');

require('alpinejs');

import * as monaco from 'monaco-editor';
import $ from 'jquery';

window.$ = window.jQuery = $;

let editors = [];

window.fullScreen = false;

window.scrollToTop = function () {
    function scrollToSmoothly(pos, time) {
        var currentPos = window.pageYOffset;
        var start = null;
        if(time == null) time = 500;
        pos = +pos, time = +time;
        window.requestAnimationFrame(function step(currentTime) {
            start = !start ? currentTime : start;
            var progress = currentTime - start;
            if (currentPos < pos) {
                window.scrollTo(0, ((pos - currentPos) * progress / time) + currentPos);
            } else {
                window.scrollTo(0, currentPos - ((currentPos - pos) * progress / time));
            }
            if (progress < time) {
                window.requestAnimationFrame(step);
            } else {
                window.scrollTo(0, pos);
            }
        });
    }

    scrollToSmoothly(0, 600);
};

window.updateEditorSize = function (container, editor) {
    let contentHeight = Math.min(1000, editor.getContentHeight());
    let contentWidth = container.innerWidth();
    if (contentHeight < 450) {
        contentHeight = 450;
    }

    if (window.fullScreen) {
        contentHeight = $(window).innerHeight();
        contentWidth = $(window).innerWidth();
    }

    container.css('height', `${contentHeight}px`);
    try {
        editor.layout({ width: contentWidth, height: contentHeight });
    } finally {

    }
};

window.updateEditorSizes = function () {
    editors.forEach(function (data) {
        window.updateEditorSize(data.container, data.editor);
    });
};

$(document).on('scroll', updateEditorSizes);
$(window).resize(updateEditorSizes);

$('[privbin-editor]').each(function () {
    let container = $(this);
    let id = container.attr("privbin-editor");
    let element = $("#" + id + "_editor");
    let value = atob($("#" + id).html());
    let options = {};

    options.value = value;
    options.lineNumbers = 'on';
    options.theme = 'vs-dark';
    options.smoothScrolling = true;
    options.renderWhitespace = 'all';
    options.renderFinalNewline = true;
    options.renderControlCharacters = true;
    options.overviewRulerBorder = true;
    options.occurrencesHighlight = true;
    options.mouseWheelZoom = true;
    options.formatOnPaste = true;
    options.scrollBeyondLastLine = false;
    options.wordWrap = 'false';
    options.wrappingStrategy = 'advanced';
    options.minimap = {showSlider: 'always'};

    let language = element.attr('privbin-editor-language');
    if (typeof language !== 'undefined' && language !== false) {
        options.language = language;
    }

    let readonly = $(this).attr('readonly');
    if (typeof readonly !== 'undefined' && readonly !== false) {
        options.readOnly = true;
    }

    let theme = $(this).attr('theme');
    if (typeof theme !== 'undefined' && theme !== false) {
        options.theme = theme;
    }

    let editor = monaco.editor.create(element[0], options);
    editors.push({container: container, editor: editor});

    let lines = container.attr('highlighted-lines');
    if (typeof lines !== 'undefined' && lines !== false) {
        JSON.parse(lines).forEach(function (line) {
            editor.deltaDecorations([], [
                { range: new monaco.Range(line,1, line + 1, 1), options: { inlineClassName: 'bg-yellow-800 bg-opacity-50 py-1.5' }},
            ]);
        });
    }

    editor.onDidContentSizeChange(function () {
        window.updateEditorSize(container, editor);
    });
    window.updateEditorSize(container, editor);

    $(this).closest('form.has-editor')[0].addEventListener('formdata', e => {
        e.formData.append('content', editor.getModel().getValue());
    });

    $('[editor-language-selector]').change(function () {
        monaco.editor.setModelLanguage(editor.getModel(), $(this).val());
    });
});

$('[privbin-highlighter]').each(function () {
    let element = $(this);
    let options = {};
    options.theme = 'vs-dark';
    let highlighter = monaco.editor.colorizeElement(element[0], options);
});
