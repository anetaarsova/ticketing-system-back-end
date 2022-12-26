<?php


namespace App\Http\Controllers;


use App\Tickets\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TicketController
{
    protected $ticketService;

    function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json($this->ticketService->getAll()->toArrayWithMetadata());
    }

    public function getTicketsByUser($userId): JsonResponse
    {
        return response()->json($this->ticketService->getTicketsPerUser($userId)->toArrayWithMetadata());
    }
    public function store(Request $request)
    {
        $request->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data = $request->all();

        if($request->hasFile('image')){

            $file = $request->file('image');
//            $filename= $file->getClientOriginalName();
//            $folder = uniqid() . '-' . now()->timestamp;


            $imageName = time().'.'.$request->image->extension();
            //$request->image->move(public_path('images'), $imageName);
            $request->image->storeAs('public',$imageName);

//            Image::make(storage_path('app/public/tickets/'. $folder . $filename))
//            ->fit(50,50)->save(storage_path('app/public/uploads/'. $folder . $filename));
            $data['image'] = $imageName;
        }

        return response()->json($this->ticketService->create($data)->toArrayWithMetadata());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->ticketService->show($id)->toArrayWithMetadata());
    }

    public function update($id, Request $request): JsonResponse
    {
        return response()->json($this->ticketService->update($id, $request->all())->toArrayWithMetadata());
    }

    public function destroy($id): JsonResponse
    {
        return response()->json($this->ticketService->delete($id));
    }
}
