<?php

namespace Backend\Http\Controllers\Settings;

use Backend\Http\Controllers\Controller;
use Backend\Http\Requests\SettingsRequest;
use Backend\Models\Settings;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{

    use ImageUploadTrait;

    public function __construct()
    {
        $this->middleware('permission:settings_access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingsRequest $request, Settings $settings)
    {

        return view('settings.form', [
            'model' => $settings->getAll()
        ]);

    }

    /**
     * @param SettingsRequest $request
     * @param Settings $settings
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingsRequest $request, Settings $settings)
    {

        $inputs = $request->input('settings');

        foreach ($inputs as $name => $value) :

            $settings->where('name', $name)->updateOrCreate(['name' => $name, 'value' => $value]);

        endforeach;

        /**
         * Upload Images
         */
        $images = [];
        if( $request->hasFile('site_favicon') ) $images[] = 'site_favicon';
        if( $request->hasFile('site_logo') ) $images[] = 'site_logo';
        if( $request->hasFile('site_logo_mobile') ) $images[] = 'site_logo_mobile';

        if( $images )
        {
            foreach ( $images as $image)
            {
                $model = DB::table('settings')->where('name', $image);
                $model->where('name', $image)->update([
                    'value' => $this->imageUpload((object)[$image => $model->first()->value], 'settings', $image)
                ]);
            }

        }

        $flush_images = [];
        if( $request->input('flush_image') ) $flush_images[] = 'site_logo';
        if( $request->input('flush_favicon') ) $flush_images[] = 'site_favicon';
        if( $request->input('flush_logo_mobile') ) $flush_images[] = 'site_logo_mobile';

        if( $flush_images )
        {
            foreach ( $flush_images as $flush_image)
            {
                $model = DB::table('settings')->where('name', $flush_image);
                $this->imageRemove((object)[$flush_image => $model->first()->value], 'settings', $flush_image);
                $model->where('name', $flush_image)->update(['value' => null]);
            }

        }

        return back()->with('message', __( 'Сохранено' ));

    }

}
