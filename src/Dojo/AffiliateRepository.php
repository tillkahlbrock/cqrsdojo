<?php

namespace Dojo;

class AffiliateRepository
{
    private $storage = array();

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

        $this->storeAffiliate($id, $affiliate);

        return $affiliate;
    }

    public function retrieve($affiliateId)
    {
        if (isset($this->storage[$affiliateId])) {
            return $this->storage[$affiliateId];
        }

        return null;
    }

    public function update(Affiliate $affilate)
    {
        $this->storeAffiliate($affilate->getId(), $affilate);
    }

    public function delete($affiliateId)
    {
        if (isset($this->storage[$affiliateId])) {
            unset($this->storage[$affiliateId]);
        }
    }

    public function index()
    {
        $browser = new \Buzz\Browser();
        $response = $browser->get('http://localhost:5984/affiliate/_design/all/_view/all');

        $data = json_decode($response->getContent(), true);
        $rows = $data['rows'];
        $affiliates = array();

        foreach ($rows as $row) {
            $affiliates[] = $row['value'];
        }

        return json_encode($affiliates);
    }

    private function storeAffiliate($id, $affiliate)
    {
        $browser = new \Buzz\Browser();
        $browser->post('http://localhost:5984/affiliate', array('Content-Type' => 'application/json'), json_encode($affiliate));
    }
}
