<?php

namespace Waynestate\Nova\CKEditor4Field\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;

class UploadController extends Controller
{
    /**
     * Store an attachment for a Trix field.
     *
     * @param NovaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NovaRequest $request)
    {
        $field = $request->newResource()
            ->availableFields($request)
            ->findFieldByAttribute($request->field, function () {
                abort(404);
            });

        return response()->json([
            'uploaded' => true,
            'url' => call_user_func(
                $field->attachCallback,
                $request
            ),
        ]);
    }

    /**
     * Purge all pending attachments for a Trix field.
     *
     * @param NovaRequest $request
     * @return Response
     */
    public function destroyPending(NovaRequest $request)
    {
        $field = $request->newResource()
            ->availableFields($request)
            ->findFieldByAttribute($request->field, function () {
                abort(404);
            });

        return call_user_func($field->discardCallback, $request);
    }
}
