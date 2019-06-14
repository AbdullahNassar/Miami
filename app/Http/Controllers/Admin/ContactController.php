<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use App\ContactTrans;
use SMKFontAwesome\SMKFontAwesome;
use App\Language;
use Config;

class ContactController extends Controller {

    //
    public function getIndex() {
        $data = ContactTrans::where('lang', Config::get('app.locale'))->get();
        $icons = SMKFontAwesome::getArray();
        $lang = Language::get();

        return view('admin.pages.contact.index', compact('data', 'icons', 'lang'));
    }

    public function getEdit(Request $request, $id) {
        $data = ContactTrans::where('contact_id', $id)->get();
        $icons = SMKFontAwesome::getArray();

        return view('admin.pages.contact.edit', compact('data', 'icons'));
    }

    public function postIndex(Request $request) {
        $v = Validator($request->all(), [
            'icon' => 'required',
            'title' => 'required|min:1',
            'content' => 'required|min:1'
                ], [
            'icon.required' => 'Please insert an icon',
            'title.required' => 'Please insert the title',
            'title.min' => 'Title should be at least one word',
            'content.required' => 'Please insert the content',
            'content.min' => 'Content should be at least one word'
        ]);

        if ($v->fails()) {
            return ['status' => 'error', 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $contact = new Contact();
        $trans = new ContactTrans();

        $contact->icon = $request->icon;

        if ($contact->save()) {
            $contact->translate()->create([
                'title' => $request->title,
                'content' => $request->content,
                'lang' => $request->lang
            ]);

            return ['status' => 'success', 'data' => 'Your data has been added successfully'];
        }

        return ['status' => 'error', 'data' => 'Error please try again later'];
    }

    public function postTrans(Request $request) {
        $v = Validator($request->all(), [
            'title' => 'required|min:1',
            'content' => 'required|min:1'
                ], [
            'title.required' => 'Please insert the title',
            'title.min' => 'Title should be at least one word',
            'content.required' => 'Please insert the content',
            'content.min' => 'Content should be at least one word'
        ]);

        if ($v->fails()) {
            return ['status' => 'error', 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $data = new ContactTrans();

        $data->title = $request->title;
        $data->content = $request->content;
        $data->lang = $request->lang;
        $data->contact_id = $request->contact_id;

        if ($data->save()) {
            return ['status' => 'success', 'data' => 'Translation has been added successfully'];
        }
    }

    public function postEdit(REquest $request, $id) {
        $v = Validator($request->all(), [
            'icon' => 'required',
            'title' => 'required|min:1',
            'content' => 'required|min:1'
                ], [
            'icon.required' => 'Please insert an icon',
            'title.required' => 'Please insert the title',
            'title.min' => 'Title should be at least one word',
            'content.required' => 'Please insert the content',
            'content.min' => 'Content should be at least one word'
        ]);

        if ($v->fails()) {
            return ['status' => 'error', 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $contact = Contact::find($id);

        $contact->icon = $request->icon;

        if ($contact->save()) {
            $contact->translate()->where('contact_id', $id)->where('lang', $request->lang)->update([
                'title' => $request->title,
                'content' => $request->content
            ]);

            return ['status' => 'success', 'data' => 'Data has been updated successfully'];
        }

        return ['status' => 'error', 'data' => 'Error please try again later'];
    }

    public function getDelete($id = null) {
        $data = Contact::find($id);

        $data->translate()->delete();
        $data->delete();

        return redirect()->back();
    }

}
