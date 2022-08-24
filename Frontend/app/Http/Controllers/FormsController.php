<?php
namespace Frontend\Http\Controllers;

use Backend\Enums\FormsEnum;
use Frontend\Http\Requests\FormsRequest;
use Frontend\Models\FormsData;
use Frontend\Events\FormsDataEvent;
use Frontend\Jobs\FormsDataBitrixJob;

class FormsController extends Controller
{

    /**
     * @param FormsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FormsRequest $request)
    {

        $model = new FormsData($request->input());

        if ($model->save()) {

            //event(new FormsDataEvent($model));

            FormsDataBitrixJob::dispatch($model, $request->all());

            $template = '';
            switch ($model->type) {

                case FormsEnum::reviews:
                    $template = 'partials.modal.message.reviews';
                    break;

                case FormsEnum::consultation:
                    $template = 'partials.modal.message.consultation';
                    break;

                case FormsEnum::payment:
                    $template = 'partials.modal.message.payment';
                    break;

                case FormsEnum::feedback:
                    $template = 'partials.modal.message.feedback';
                    break;

                case FormsEnum::question:
                    $template = 'partials.modal.message.question';
                    break;

                case FormsEnum::faq:
                    $template = 'partials.modal.message.faq';
                    break;

                case FormsEnum::partners:
                    $template = 'partials.modal.message.partners';
                    break;

                case FormsEnum::support:
                    $template = 'partials.modal.message.support';
                    break;

                case FormsEnum::subscribe:
                    $template = 'partials.modal.message.subscribe';
                    break;

                case FormsEnum::request:
                    $template = 'partials.modal.message.question';
                    break;

                default:
                    $template = 'partials.modal.message.default';

            }

            //EmailToAdminJob::dispatch($model)->delay(now()->addMinutes(1));


//            Notification::route('mail', 'remstroyod@gmail.com')
//                ->notify(new FormsAdminNotification($model));


            return response()->json([
                'status' => 'success',
                'message' => view($template, ['model' => $model])->render(),
            ], 200);

        } else {

            return response()->json([
                'status' => 'error',
                'message' => __( 'Не удалось отправить сообщение.' )
            ], 400);

        }

    }

}
