<?php

namespace Mwteam\Guide\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Mwteam\Guide\App\Http\Requests\GuideRequest;
use Mwteam\Guide\App\Models\Guide;
use Mwteam\Guide\App\Models\GuideCategory;

class GuideController extends Controller
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
        $this->authorize('index', Guide::class);

        $search = $this->search($_GET);
        if ($search){
            $guides = $search;
        }else{
            $guides = Guide::with(['author', 'editor'])->orderBy('updated_at', 'DESC')->paginate(10);
        }

        return view('Guide::dashboard.guides.index', compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Guide::class);

        $categories = GuideCategory::where('language', config('app.locale'))->pluck('name', 'id')->all();

        $parents = Guide::whereNull('parent_id')->pluck('title', 'id')->all();

        return view('Guide::dashboard.guides.create', compact('categories', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GuideRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(GuideRequest $request)
    {
        $this->authorize('create', Guide::class);
        $input = $request->all();

        $uniqueness = $this->isUniqueGuideBasedOnLanguage($input['parent_id'], $input['language']);
        $input['parent_id'] = $uniqueness['parent'];
        $uniqueGuide = $uniqueness['unique'];

        if (!$uniqueGuide){
            Session::flash('danger', 'راهنمای انتخابی با این زبان وجود دارد.');
            return redirect()->back()->withInput($request->all());
        }else{
            $guide = Guide::create([
                'guide_category_id' => $input['guide_category_id'] < 0 ? null : $input['guide_category_id'],
                'author_id' => auth()->user()->getAuthIdentifier(),
                'parent_id' => $input['parent_id'],
                'language' => $input['language'],
                'title' => $input['title'],
                'body' => $input['body'],
            ]);

            if ($guide){
                Session::flash('success', 'راهنما با موفقیت ساخته شد.');
                return redirect(route('dashboard.guide.index'));
            }else{
                Session::flash('danger', 'مشکلی در ساخت راهنما رخ داد. لطفاً بعداً تلاش نمایید.');
                return redirect(route('dashboard.guide.index'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function show(Guide $guide)
    {
        dd($guide);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Guide $guide
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Guide $guide)
    {
        $this->authorize('edit', Guide::class);

        $categories = GuideCategory::where('language', config('app.locale'))->pluck('name', 'id')->all();

        $parents = Guide::whereNull('parent_id')->pluck('title', 'id')->all();

        return view('Guide::dashboard.guides.edit', compact('guide', 'categories', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GuideRequest $request
     * @param Guide $guide
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(GuideRequest $request, Guide $guide)
    {
        $this->authorize('edit', Guide::class);
        $input = $request->all();

        $uniqueGuide = true;
        if ($input['parent_id'] != $guide->parent_id || $input['language'] != $guide->language) {
            $uniqueness = $this->isUniqueGuideBasedOnLanguage($input['parent_id'], $input['language']);
            $input['parent_id'] = $uniqueness['parent'];
            $uniqueGuide = $uniqueness['unique'];
        }

        if (!$uniqueGuide){
            Session::flash('danger', 'راهنمای انتخابی با این زبان وجود دارد.');
            return redirect()->back()->withInput($request->all());
        }else{
            $updateResult = $guide->update([
                'guide_category_id' => $input['guide_category_id'] < 0 ? null : $input['guide_category_id'],
                'editor_id' => auth()->user()->getAuthIdentifier(),
                'parent_id' => $input['parent_id'],
                'language' => $input['language'],
                'title' => $input['title'],
                'body' => $input['body'],
            ]);

            if ($updateResult){
                Session::flash('success', 'راهنما با موفقیت ویرایش شد.');
                return redirect(route('dashboard.guide.index'));
            }else{
                Session::flash('danger', 'مشکلی در ویرایش راهنما رخ داد. لطفاً بعداً تلاش نمایید.');
                return redirect(route('dashboard.guide.index'));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Guide $guide
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Throwable
     */
    public function destroy(Guide $guide)
    {
        $this->authorize('delete', Guide::class);

        try {
            DB::transaction(function () use ($guide) {
                $guide->children->isEmpty() ?: $guide->children()->delete();
                $guide->delete();
            }, 3);
            Session::flash('success', "راهنما '{$guide->title}' با موفقیت حذف شد.");
        }catch (\Exception $exception){
            Log::debug("Error when deleting articles" . PHP_EOL . $exception->getMessage());
            Session::flash('danger', 'حذف راهنما با مشکل مواجه شد. لطفاً بعداً تلاش نمایید.');
        }

        return redirect(route('dashboard.guide.index'));
    }

    private function search($data)
    {
        if (isset($data['title']) || isset($data['user'])) {
            if ($data['user'] != '') {
                $userIDs = User::adminOrSuperAdmin()->whereRaw("CONCAT_WS (' ', first_name, last_name) like '%{$data['user']}%'")->select('id')->get()->toArray();

                $users = array_map(function($userID){
                    return $userID['id'];
                }, $userIDs);
            }

            if ($data['title'] != '') {
                $title = $data['title'];
            }

            $guides = Guide::with(['author', 'editor']);

            if (isset($title)){
                $guides->where('title', 'like', "%{$title}%");
            }

            if (isset($users)) {
                $guides->whereIn('author_id', $users);
            }

            return $guides->orderBy('updated_at', 'DESC')->paginate(10);
        }else{
            return false;
        }
    }

    private function isUniqueGuideBasedOnLanguage($parent, $language)
    {
        $unique = true;
        if ($parent > 0) {
            $parentGuide = Guide::with('children')->findOrFail($parent);

            if ($language == $parentGuide->language) {
                $unique = false;
            } else {
                foreach ($parentGuide->children as $child) {
                    if ($language == $child->language) {
                        $unique = false;
                        break;
                    }
                }
            }
        }else{
            $parent = null;
        }

        return [
            'parent' => $parent,
            'unique' => $unique,
        ];
    }
}
