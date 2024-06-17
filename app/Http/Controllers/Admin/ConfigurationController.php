<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Configuration\Colors;
use App\Http\Requests\Admin\Configuration\Contact;
use App\Http\Requests\Admin\Configuration\Effects;
use App\Http\Requests\Admin\Configuration\HeadSearch;
use App\Http\Requests\Admin\Configuration\Shortcuts;
use App\Http\Requests\Admin\Configuration\SiteUp;
use App\Http\Requests\Admin\Image as ImageRequest;
use App\Models\Admin\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller {
    public function getConfiguration() {
        $configuration = Configuration::first();
        if ($configuration == null) {
            abort(404);
        }

        return response()->json($configuration->options);
    }

    public function setContact(Contact $request) {
        $configuration = Configuration::first();
        $configuration->options = array_merge($configuration->options, ['contact_email' =>  $request->email]);
        $configuration->save();

        return response()->json($configuration);
    }

    public function setColors(Colors $request) {
        $configuration = Configuration::first();
        $configuration->options = array_merge($configuration->options, [
            'navbar_back_color'  => $request->navbar_back_color,
            'sidebar_back_color' => $request->sidebar_back_color,
        ]);
        $configuration->save();

        return response()->json($configuration);
    }

    public function setLoginBackground(ImageRequest $request) {
        $configuration = Configuration::first();
        $file_name = 'backlogin.'.$request->file('image')->getClientOriginalExtension();
        $path = $request->file('image')->storeAs('admin/configuration', $file_name, 'public');
        $configuration->options = array_merge($configuration->options, ['login_background_url' =>  $path]);
        $configuration->save();

        return response()->json($configuration);
    }

    public function setEffects(Effects $request) {
        $configuration = Configuration::first();
        $configuration->options = array_merge($configuration->options, ['transition'  => $request->transition]);
        $configuration->save();

        return response()->json($configuration);
    }

    public function setSiteUp(SiteUp $request) {
        $configuration = Configuration::first();
        $configuration->options = array_merge($configuration->options, ['front_site_up' =>  $request->front_site_up]);
        $configuration->save();

        return response()->json($configuration);
    }

    public function setSearchHeader(HeadSearch $request) {
        $configuration = Configuration::first();
        $configuration->options = array_merge($configuration->options, ['header_search' =>  $request->header_search]);
        $configuration->save();

        return response()->json($configuration);
    }

    public function setShortcuts(Shortcuts $request) {
        $configuration = Configuration::first();
        $configuration->options = array_merge($configuration->options, ['shortcuts' =>  $request->shortcuts]);
        $configuration->save();

        return response()->json($configuration);
    }

    public function setAdminLogo(ImageRequest $request) {
        $configuration = Configuration::first();
        $file_name = 'logo.'.$request->file('image')->getClientOriginalExtension();
        $path = $request->file('image')->storeAs('admin/configuration', $file_name, 'public');
        $configuration->options['admin_logo'] = $path;
        $configuration->options = array_merge($configuration->options, ['admin_logo' =>  $path]);
        $configuration->save();

        return response()->json($configuration);
    }

    public function setLanguage(Request $request) {
        $configuration = Configuration::first();
        $configuration->options = array_merge($configuration->options, ['language' =>  $request->language]);
        $configuration->save();

        return response()->json($configuration);
    }

    public function getAuthBackground() {
        $configuration = Configuration::first();
        if ($configuration == null) {
            abort(404);
        }

        return response()->json(['login_background_url' => $configuration->options['login_background_url']]);
    }

    public function resetLoginBackground() {
        $configuration = Configuration::first();
        $configuration->options = array_merge($configuration->options, ['login_background_url' =>  null]);
        $configuration->save();

        return response()->json($configuration);
    }
}
