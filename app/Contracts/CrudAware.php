<?php

namespace App\Contracts;

interface CrudAware
{
    /**
     * Create a resource
     *
     * @param $data
     * @return mixed
     */
    public function create($data);

    /**
     * Update a resource
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data);

    /**
     * Delete a resource
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
