<?php

namespace Dojo;

class AffiliateRepository
{
    private $storage = array();

    private $databaseAdapter;

    public function __construct(\Dojo\DatabaseAdapter $databaseAdapter)
    {
        $this->databaseAdapter = $databaseAdapter;
    }

    public function create($data)
    {
        $id = $data['id'];
        $affiliate =  new Affiliate();

        $affiliate->setId($id);

        if (isset($data['name'])) {
            $affiliate->setName($data['name']);
        }

        if (isset($data['country'])) {
            $affiliate->setCountry($data['country']);
        }

        $this->databaseAdapter->store($data);

        return $affiliate;
    }

    public function retrieve($affiliateId)
    {
        $data = $this->databaseAdapter->retrieve($affiliateId);
        $affiliate =  new Affiliate();

        $affiliate->setId($data['id']);
        $affiliate->setName($data['name']);
        $affiliate->setCountry($data['country']);

        return $affiliate;

    }

    public function update(Affiliate $affilate)
    {
        $data = array(
            'id' => $affilate->getId(),
            'name' => $affilate->getName(),
            'country' => $affilate->getCountry()
        );

        $this->databaseAdapter->update($data);
    }

    public function delete($affiliateId)
    {
        $this->databaseAdapter->delete($affiliateId);
    }

    public function index()
    {
        return $this->storage;
    }

    private function storeAffiliate($id, $affiliate)
    {
        $browser = new \Buzz\Browser();
        $browser->post('http://localhost:5984/affiliate', array('Content-Type' => 'application/json'), json_encode($affiliate));

    }
}
