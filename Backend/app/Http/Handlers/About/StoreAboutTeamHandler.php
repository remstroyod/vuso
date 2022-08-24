<?php

namespace Backend\Http\Handlers\About;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\About\TeamRequest;
use Backend\Models\About\Team;
use Backend\Models\Pages;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreAboutTeamHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param AwardsRequest $request
     * @param Awards|null $awards
     * @return Awards|null
     */
    public function process(TeamRequest $request, Team $team = null): ?Team
    {

        try {

            if (!$team) :
                $team = new Team();
                $response = Gate::inspect('create', Pages::class);
            else:
                $response = Gate::inspect('update', Pages::findOrFail('about'));
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $team->fill($request->all());

            $team->save($request->all());

            /**
             * Upload Image
             */
            if( $request->hasFile('image') )
            {
                $team->update(['image' => $this->imageUpload($team, 'about/team')]);
            }

            if ($request->hasFile('image_revert'))
            {
                $team->update(['image_revert' => $this->imageUpload($team, 'about/team', 'image_revert')]);
            }

            /**
             * Remove Image
             */
            if ($request->input('flush_image'))
            {

                $this->imageRemove($team, 'about/team');
                $team->update(['image' => null]);

            }
            if ($request->input('flush_avatar'))
            {

                $this->imageRemove($team, 'about/team', 'image_revert');
                $team->update(['image_revert' => null]);

            }

            return $team;

        } catch (\Throwable $e) {

            $this->setErrors(__( 'Не удалось сохранить запись' ));
            return null;

        }

    }

}
