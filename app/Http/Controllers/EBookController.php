<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;

class EBookController extends BaseController
{
    public function index()
    {
        try {
            $query = DB::table('lessons')
                ->join('contents', 'contents.id', '=', 'lessons.content_id')
                ->join('ebooks', 'ebooks.id', '=', 'contents.ebook_id')
                ->join('authors', 'authors.id', '=', 'ebooks.author_id')
                ->join('categories', 'categories.id', '=', 'ebooks.category_id')
                ->where('ebooks.status', '=', 1)
                ->select([
                    'authors.id as author_id',
                    'authors.author_kh',
                    'authors.author_eng',
                    'authors.desc_kh as author_desc_kh',
                    'authors.desc_eng as author_desc_eng',

                    'categories.id as category_id',
                    'categories.category_kh',
                    'categories.category_eng',

                    'ebooks.id as ebook_id',
                    'ebooks.ebook_kh',
                    'ebooks.ebook_eng',
                    'ebooks.price',
                    'ebooks.desc_kh as ebook_desc_kh',
                    'ebooks.desc_eng as ebook_desc_eng',
                    'ebooks.images as ebook_image',
                    'ebooks.count_view',
                    'ebooks.orderby as ebook_order',
                    'ebooks.status as ebook_status',

                    'contents.id as content_id',
                    'contents.content_kh',
                    'contents.content_eng',
                    'contents.count_minute',
                    'contents.is_read',
                    'contents.orderby as content_order',

                    'lessons.id as lesson_id',
                    'lessons.header_kh',
                    'lessons.header_eng',
                    'lessons.sub_header_kh',
                    'lessons.sub_header_eng',
                    'lessons.images as lesson_image',
                    'lessons.orderby as lesson_order',
                ])
                ->get();

            if ($query->count()) {
                foreach ($query as $row) {
                    $data[$row->author_id]['author_id'] = $row->author_id;
                    $data[$row->author_id]['author_kh'] = $row->author_kh;
                    $data[$row->author_id]['author_eng'] = $row->author_eng;
                    $data[$row->author_id]['desc_kh'] = $row->author_desc_kh;
                    $data[$row->author_id]['desc_eng'] = $row->author_desc_eng;

                    $categorys[$row->author_id][$row->category_id]['category_id'] = $row->category_id;
                    $categorys[$row->author_id][$row->category_id]['category_kh'] = $row->category_kh;
                    $categorys[$row->author_id][$row->category_id]['category_eng'] = $row->category_eng;

                    $ebooks[$row->category_id][$row->ebook_id]['ebook_id'] = $row->ebook_id;
                    $ebooks[$row->category_id][$row->ebook_id]['ebook_kh'] = $row->ebook_kh;
                    $ebooks[$row->category_id][$row->ebook_id]['ebook_eng'] = $row->ebook_eng;
                    $ebooks[$row->category_id][$row->ebook_id]['price'] = $row->price;
                    $ebooks[$row->category_id][$row->ebook_id]['desc_kh'] = $row->ebook_desc_kh;
                    $ebooks[$row->category_id][$row->ebook_id]['desc_eng'] = $row->ebook_desc_eng;
                    $ebooks[$row->category_id][$row->ebook_id]['image'] = $row->ebook_image;
                    $ebooks[$row->category_id][$row->ebook_id]['count_view'] = $row->count_view;
                    $ebooks[$row->category_id][$row->ebook_id]['order'] = $row->ebook_order;
                    $ebooks[$row->category_id][$row->ebook_id]['status'] = $row->ebook_status;

                    $contents[$row->ebook_id][$row->content_id]['content_id'] = $row->content_id;
                    $contents[$row->ebook_id][$row->content_id]['content_kh'] = $row->content_kh;
                    $contents[$row->ebook_id][$row->content_id]['content_eng'] = $row->content_eng;
                    $contents[$row->ebook_id][$row->content_id]['count_minute'] = $row->count_minute;
                    $contents[$row->ebook_id][$row->content_id]['is_read'] = $row->is_read;
                    $contents[$row->ebook_id][$row->content_id]['order'] = $row->content_order;

                    $lessons[$row->content_id][$row->lesson_id]['lesson_id'] = $row->lesson_id;
                    $lessons[$row->content_id][$row->lesson_id]['header_kh'] = $row->header_kh;
                    $lessons[$row->content_id][$row->lesson_id]['header_eng'] = $row->header_eng;
                    $lessons[$row->content_id][$row->lesson_id]['sub_kh'] = $row->sub_header_kh;
                    $lessons[$row->content_id][$row->lesson_id]['sub_eng'] = $row->sub_header_eng;
                    $lessons[$row->content_id][$row->lesson_id]['image'] = $row->lesson_image;
                    $lessons[$row->content_id][$row->lesson_id]['order'] = $row->lesson_order;

                    $data[$row->author_id]['categories'] = array_values($categorys[$row->author_id]);
                    $categorys[$row->author_id][$row->category_id]['ebooks'] = array_values($ebooks[$row->category_id]);
                    $ebooks[$row->category_id][$row->ebook_id]['contents'] = array_values($contents[$row->ebook_id]);
                    $contents[$row->ebook_id][$row->content_id]['lessons'] = array_values($lessons[$row->content_id]);
                }
                return $this->normalResponse(array_values($data));
            }
            $message = app_lang('No Data Available!', 'មិនមានទិន្នន័យ!');
            return $this->noDataAvailable($message);
        } catch (\Throwable $throwable) {
            return $this->errorsResponse($throwable);
        }
    }

    public function popularBook()
    {
        try {
            $query = DB::table('lessons')
                ->join('contents', 'contents.id', '=', 'lessons.content_id')
                ->join('ebooks', 'ebooks.id', '=', 'contents.ebook_id')
                ->join('authors', 'authors.id', '=', 'ebooks.author_id')
                ->join('categories', 'categories.id', '=', 'ebooks.category_id')
                ->where('ebooks.status', '=', 1)
                ->select([
                    'authors.id as author_id',
                    'authors.author_kh',
                    'authors.author_eng',
                    'authors.desc_kh as author_desc_kh',
                    'authors.desc_eng as author_desc_eng',

                    'categories.id as category_id',
                    'categories.category_kh',
                    'categories.category_eng',

                    'ebooks.id as ebook_id',
                    'ebooks.ebook_kh',
                    'ebooks.ebook_eng',
                    'ebooks.price',
                    'ebooks.count_view',
                    'ebooks.desc_kh as ebook_desc_kh',
                    'ebooks.desc_eng as ebook_desc_eng',
                    'ebooks.images as ebook_image',
                    'ebooks.orderby as ebook_order',
                    'ebooks.status as ebook_status',

                    'contents.id as content_id',
                    'contents.content_kh',
                    'contents.content_eng',
                    'contents.count_minute',
                    'contents.is_read',
                    'contents.orderby as content_order',

                    'lessons.id as lesson_id',
                    'lessons.header_kh',
                    'lessons.header_eng',
                    'lessons.sub_header_kh',
                    'lessons.sub_header_eng',
                    'lessons.images as lesson_image',
                    'lessons.orderby as lesson_order',
                ])
                ->orderBy('ebooks.count_view')
                ->get();

            if ($query->count()) {
                foreach ($query as $row) {
                    $data[$row->author_id]['author_id'] = $row->author_id;
                    $data[$row->author_id]['author_kh'] = $row->author_kh;
                    $data[$row->author_id]['author_eng'] = $row->author_eng;
                    $data[$row->author_id]['desc_kh'] = $row->author_desc_kh;
                    $data[$row->author_id]['desc_eng'] = $row->author_desc_eng;

                    $categorys[$row->author_id][$row->category_id]['category_id'] = $row->category_id;
                    $categorys[$row->author_id][$row->category_id]['category_kh'] = $row->category_kh;
                    $categorys[$row->author_id][$row->category_id]['category_eng'] = $row->category_eng;

                    $ebooks[$row->category_id][$row->ebook_id]['ebook_id'] = $row->ebook_id;
                    $ebooks[$row->category_id][$row->ebook_id]['ebook_kh'] = $row->ebook_kh;
                    $ebooks[$row->category_id][$row->ebook_id]['ebook_eng'] = $row->ebook_eng;
                    $ebooks[$row->category_id][$row->ebook_id]['price'] = $row->price;
                    $ebooks[$row->category_id][$row->ebook_id]['count_view'] = $row->count_view;
                    $ebooks[$row->category_id][$row->ebook_id]['desc_kh'] = $row->ebook_desc_kh;
                    $ebooks[$row->category_id][$row->ebook_id]['desc_eng'] = $row->ebook_desc_eng;
                    $ebooks[$row->category_id][$row->ebook_id]['image'] = $row->ebook_image;
                    $ebooks[$row->category_id][$row->ebook_id]['status'] = $row->ebook_status;
 
                    $contents[$row->ebook_id][$row->content_id]['content_id'] = $row->content_id;
                    $contents[$row->ebook_id][$row->content_id]['content_kh'] = $row->content_kh;
                    $contents[$row->ebook_id][$row->content_id]['content_eng'] = $row->content_eng;
                    $contents[$row->ebook_id][$row->content_id]['count_minute'] = $row->count_minute;
                    $contents[$row->ebook_id][$row->content_id]['is_read'] = $row->is_read;
                    $contents[$row->ebook_id][$row->content_id]['order'] = $row->content_order;

                    $lessons[$row->content_id][$row->lesson_id]['lesson_id'] = $row->lesson_id;
                    $lessons[$row->content_id][$row->lesson_id]['header_kh'] = $row->header_kh;
                    $lessons[$row->content_id][$row->lesson_id]['header_eng'] = $row->header_eng;
                    $lessons[$row->content_id][$row->lesson_id]['sub_kh'] = $row->sub_header_kh;
                    $lessons[$row->content_id][$row->lesson_id]['sub_eng'] = $row->sub_header_eng;
                    $lessons[$row->content_id][$row->lesson_id]['image'] = $row->lesson_image;
                    $lessons[$row->content_id][$row->lesson_id]['order'] = $row->lesson_order;

                    $data[$row->author_id]['categories'] = array_values($categorys[$row->author_id]);
                    $categorys[$row->author_id][$row->category_id]['ebooks'] = array_values($ebooks[$row->category_id]);
                    $ebooks[$row->category_id][$row->ebook_id]['contents'] = array_values($contents[$row->ebook_id]);
                    $contents[$row->ebook_id][$row->content_id]['lessons'] = array_values($lessons[$row->content_id]);
                }
                return $this->normalResponse(array_values($data));
            }
            $message = app_lang('No Data Available!', 'មិនមានទិន្នន័យ!');
            return $this->noDataAvailable($message);
        } catch (\Throwable $throwable) {
            return $this->errorsResponse($throwable);
        }
    }
}
