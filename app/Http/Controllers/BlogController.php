<?php

namespace App\Http\Controllers;

use Illuminate\Support\HtmlString;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Wink\WinkPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = WinkPost::with('tags')
            ->live()
            ->orderBy('publish_date', 'DESC')
            ->simplePaginate(12);

        return view('blog.index', [
            'posts' => $posts,
        ]);
    }

    public function show($slug)
    {
        $post = WinkPost::live()->whereSlug($slug)->firstOrFail();

        $content = $this->getPostContent($post);

        return view('blog.show', [
            'post' => $post,
            'content' => $content,
        ]);
    }

    private function getPostContent(WinkPost $post): string
    {
        $converter = new GithubFlavoredMarkdownConverter([
            'allow_unsafe_links' => false,
        ]);

        $html = $converter->convert($post->body);

        return new HtmlString($html->getContent());
    }
}
