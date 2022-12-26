<?php


namespace App\Tickets\Services;


use App\App\Services\AbstractService;
use App\Contracts\CrudAware;
use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;

class TicketService extends AbstractService implements CrudAware
{
    public function getAll(): TicketService
    {
        $tickets = Ticket::all();

        $this->setResponseData($tickets->toArray());
        $this->addResponseMetadata('count', count($tickets));

        return $this;
    }

    public function create($data): TicketService
    {
        $ticket = Ticket::create($data);
        $this->setResponseData($ticket->toArray());

        return $this;

    }

    /**
     * Show ticket
     *
     * @param $id
     * @return $this
     */
    public function show($id): TicketService
    {
        $ticket = Ticket::find($id);
        $this->setResponseData($ticket->toArray());

        return $this;
    }

    /**
     * @param $id
     * @param $data
     * @return $this
     */
    public function update($id, $data): TicketService
    {
        $ticket = Ticket::find($id);
        $ticket->update($data);
        $this->setResponseData($ticket->toArray());

        return $this;
    }

    /**
     * Delete a resource
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $ticket = Ticket::find($id);
        if($ticket->image) {
            Storage::delete('/public' . $ticket->image);
        }
        return $ticket->delete();
    }

    /**
     * Return tickets per user
     * @param $userId
     * @return $this
     */
    public function getTicketsPerUser($userId): TicketService
    {
        $tickets = Ticket::where('user_id', $userId)
            ->orderBy('id', 'desc')->get();
        $response['tickets'] = $tickets->toArray();

        $this->setResponseData($response);
        $this->addResponseMetadata('count', count($tickets));
        return $this;
    }

    /**
     * Return tickets by type
     * @param $type
     * @return $this
     */
    public function getTicketsPerType($type)
    {
        $tickets = Ticket::where('type', $type)
            ->orderBy('id', 'desc')->get();

        $response['tickets'] = $tickets->toArray();

        $this->setResponseData($response);
        return $this;

    }
}
