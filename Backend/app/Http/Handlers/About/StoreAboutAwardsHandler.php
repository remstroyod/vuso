<?php

namespace Backend\Http\Handlers\About;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\About\AwardsRequest;
use Backend\Models\About\Awards;
use Backend\Models\Pages;
use Backend\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreAboutAwardsHandler extends BaseHandler
{

    use FileUploadTrait;

    /**
     * @param AwardsRequest $request
     * @param Awards|null $awards
     * @return Awards|null
     */
    public function process(AwardsRequest $request, Awards $awards = null): ?Awards
    {

        try {

            if (!$awards) :
                $awards = new Awards();
                $response = Gate::inspect('create', Pages::class);
            else:
                $response = Gate::inspect('update', Pages::findOrFail('about'));
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $awards->fill($request->all());

            $awards->save($request->all());

            /**
             * Upload File
             */
            if( $request->hasFile('input_file') )
                $awards->update(['file' => $this->fileUpload($awards, 'about/awards')]);

            /**
             * Remove File
             */
            if ($request->input('flush_file')) :

                $this->fileRemove($awards, 'about/awards');
                $awards->update(['file' => null]);

            endif;

            return $awards;

        } catch (\Throwable $e) {

            $this->setErrors(__( 'Не удалось сохранить запись' ));
            return null;

        }

    }

}
