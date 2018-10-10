<?php

namespace Mwteam\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Morilog\Jalali\CalendarUtils;
use Mwteam\Blog\App\Http\Requests\BlogCommentEditRequest;
use Mwteam\Blog\App\Http\Requests\BlogCommentReplyRequest;
use Mwteam\Blog\App\Models\BlogComment;

class BlogCommentController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('index', BlogComment::class);

        $search = $this->search($_GET);
        if ($search){
            $comments = $search;
        }else{
            $comments = BlogComment::with('article')->whereHas('article')->latest()->paginate(10);
        }

        return view('Blog::dashboard.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BlogComment $blogComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BlogComment $blogComment
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(BlogComment $blogComment)
    {
        $this->authorize('edit', BlogComment::class);

        $comment = $blogComment;

        is_null($blogComment->admin_reply) ? $adminReply = '' : $adminReply = json_decode($blogComment->admin_reply);

        return view('Blog::dashboard.comments.edit', compact('comment', 'adminReply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogCommentEditRequest $request
     * @param BlogComment $blogComment
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BlogCommentEditRequest $request, BlogComment $blogComment)
    {
        $this->authorize('edit', BlogComment::class);
        $input = $request->all();

        $data = [
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'body' => $input['body'],
        ];

        switch ($input['submit']){
            case 'edit':
                $data['approved'] = 0;
                $flashMessage = 'نظر با موفقیت ویرایش شد.';
                break;
            case 'edit-approve':
                $data['approved'] = 1;
                $flashMessage = 'نظر با موفقیت تایید و ویرایش شد.';
                break;
            case 'approve':
                $data = [
                    'approved' => 1,
                ];
                $flashMessage = 'نظر با موفقیت تایید شد.';
                break;
            default:
                $data['approved'] = 0;
                $flashMessage = 'نظر با موفقیت ویرایش شد.';
        }

        $updateResult = $blogComment->update($data);

        if (!$updateResult){
            Session::flash('danger', 'ویرایش نظر با مشکل مواجه شد.');
        }else{
            Session::flash('success', $flashMessage);
        }

        return redirect(route('dashboard.blog.comments.edit', $blogComment->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogComment $blogComment
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(BlogComment $blogComment)
    {
        $this->authorize('delete', BlogComment::class);
    }

    /**
     * @param BlogCommentReplyRequest $request
     * @param BlogComment $blogComment
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function reply(BlogCommentReplyRequest $request, BlogComment $blogComment)
    {
        $this->authorize('reply', BlogComment::class);
        $input = $request->all();

        $data = [
            'name' => $input['admin-name'],
            'email' => $input['admin-email'],
            'mobile' => $input['admin-mobile'],
            'body' => $input['admin-body'],
        ];

        switch ($input['admin-submit']){
            case 'reply':
                $approved = 0;
                $flashMessage = 'پاسخ به نظر با موفقیت ثبت شد.';
                break;
            case 'reply-approve':
                $approved = 1;
                $flashMessage = 'نظر با موفقیت تایید و پاسخ به آن ثبت شد.';
                break;
            default:
                $approved = 0;
                $flashMessage = 'پاسخ به نظر با موفقیت ثبت شد.';
        }

        $updateResult = $blogComment->update([
            'admin_reply' => json_encode($data),
            'approved' => $approved
        ]);

        if (!$updateResult){
            Session::flash('danger', 'پاسخ به نظر با مشکل مواجه شد.');
        }else{
            Session::flash('success', $flashMessage);
        }

        return redirect(route('dashboard.blog.comments.edit', $blogComment->id));
    }

    /**
     * @param BlogComment $blogComment
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function approve(BlogComment $blogComment)
    {
        $this->authorize('approve', BlogComment::class);
        $blogComment->update([
            'approved' => !$blogComment->approved,
        ]);

        Session::flash('success', 'وضعیت نظر با موفقیت تغییر کرد.');
        return redirect(route('dashboard.blog.comments.index'));
    }

    private function search($data)
    {
        if (isset($data['name']) || isset($data['email']) || isset($data['mobile']) || isset($data['body']) || isset($data['approved']) || isset($data['formDate']) || isset($data['toDate'])) {
            if ($data['fromDate'] != '') {
                if (CalendarUtils::isValidateJalaliDate(...explode('/', $data['fromDate']))) {
                    $fromDate = implode('-', CalendarUtils::toGregorian(...explode('/', $data['fromDate']))) . ' 00:00:00';
                }
            }

            if ($data['toDate'] != '') {
                if (CalendarUtils::isValidateJalaliDate(...explode('/', $data['toDate']))) {
                    $toDate = implode('-', CalendarUtils::toGregorian(...explode('/', $data['toDate']))) . ' 23:59:59';
                }
            }

            if (isset($data['email']) && $data['email'] != '') {
                $email = $data['email'];
            }

            if (isset($data['mobile']) && $data['mobile'] != '') {
                $mobile = $data['mobile'];
            }

            if (isset($data['body']) && $data['body'] != '') {
                $body = $data['body'];
            }

            if (isset($data['name']) && $data['name'] != '') {
                $name = $data['name'];
            }

            if (isset($data['approved']) && $data['approved'] != '') {
                $approved = $data['approved'];
            }

            $comments = BlogComment::with('article')->whereHas('article');

            if (isset($name)){
                $comments->where('name', 'like', "%{$name}%");
            }

            if (isset($fromDate) && isset($toDate)) {
                $comments->whereBetween('created_at', [$fromDate, $toDate]);
            }elseif (isset($fromDate)){
                $comments->where('created_at', '>=', $fromDate);
            }elseif (isset($toDate)){
                $comments->where('created_at', '<=', $toDate);
            }

            if (isset($email)) {
                $comments->where('email', 'like', "%{$email}%");
            }

            if (isset($mobile)) {
                $comments->where('mobile', 'like', "%{$mobile}%");
            }

            if (isset($body)) {
                $comments->where('body', 'like', "%{$body}%");
            }

            if (isset($approved) && $approved != 'all') {
                $approved == 1 ?: $approved = 0;
                $comments->where('approved', $approved);
            }

            return $comments->latest()->paginate(10);
        }else{
            return false;
        }
    }
}
